<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\User;
use App\Models\Kelas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminSiswaController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');

        $query = Siswa::with(['user', 'kelas'])->select('siswa.*');

        if ($cari) {
            $query->where('nama_siswa', 'like', '%' . $cari . '%');
        }

        $datas = $query->paginate(config('app.pagination'));

        $pages = "siswa";
        $title = "Daftar Siswa";

        return view('pages.admin.siswa.index', compact('authSam', 'datas', 'pages', 'title', 'cari'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $kelas = Kelas::select('id', 'nama_kls')->get();
        $pages = "siswa";
        $title = "Tambah Siswa";
        return view('pages.admin.siswa.create', compact('authSam', 'kelas', 'pages', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_induk' => 'required|string|max:30|unique:siswa,no_induk',
            'nisn' => 'nullable|string|max:30|unique:siswa,nisn',
            'nama_siswa' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'kelas_id' => 'nullable|exists:kelas,id',
            'telp' => 'nullable|string|max:15',
            'tmp_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:100',
            'tgl_masuk' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|string|min:8|confirmed',

            // Validasi untuk data orang tua
            'nama_ayah' => 'nullable|string|max:50',
            'telp_ayah' => 'nullable|string|max:15',
            'pekerjaan_ayah' => 'nullable|string|max:50',
            'penghasilan_ayah' => 'nullable|numeric',
            'nama_ibu' => 'nullable|string|max:50',
            'telp_ibu' => 'nullable|string|max:15',
            'pekerjaan_ibu' => 'nullable|string|max:50',
            'penghasilan_ibu' => 'nullable|numeric',
            'alamat_orang_tua' => 'nullable|string|max:100',
        ]);

        DB::beginTransaction();

        try {
            $email = $request->email ?? 'siswa' . $request->no_induk . '@' . env('DOMAIN_EMDEFAULT', 'localemail.test');
            $password = $request->filled('password') ? bcrypt($request->password) : bcrypt(env('SISWA_PASSDEFAULT', '12345678'));

            $user = User::create([
                'name' => $request->nama_siswa,
                'email' => $email,
                'password' => $password,
                'role' => 'Siswa',
            ]);

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('siswa_fotos', 'public');
            }

            $siswa = Siswa::create([
                'user_id' => $user->id,
                'no_induk' => $request->no_induk,
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'jk' => $request->jk,
                'kelas_id' => $request->kelas_id,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'tgl_masuk' => $request->tgl_masuk,
                'foto' => $fotoPath,
            ]);

            OrangTua::create([
                'siswa_id' => $siswa->id,
                'nama_ayah' => $request->nama_ayah,
                'telp_ayah' => $request->telp_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'telp_ibu' => $request->telp_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'alamat_orang_tua' => $request->alamat_orang_tua,
            ]);

            DB::commit();

            session()->flash('success', 'Data siswa berhasil ditambahkan.');
            return redirect()->route('siswa');
        } catch (\Exception $e) {
            // \Log::error('Gagal menambahkan data guru: ' . $e->getMessage(), [
            //     'request' => $request->all(),
            // ]);
            DB::rollback();
            session()->flash('error', 'Gagal menambahkan data siswa: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $pages = "siswa";
        $title = "Edit Data Siswa";
        $siswa = Siswa::findOrFail($id);
        $orangTua = $siswa->orangTua()->first();
        $kelas = Kelas::all();

        return view('pages.admin.siswa.edit', compact('authSam', 'siswa', 'orangTua', 'kelas', 'pages', 'title'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;
        $orangTua = $siswa->orangTua()->first();

        $request->validate([
            'no_induk' => 'required|string|max:30|unique:siswa,no_induk,' . $siswa->id,
            'nisn' => 'nullable|string|max:30|unique:siswa,nisn,' . $siswa->id,
            'nama_siswa' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'kelas_id' => 'nullable|exists:kelas,id',
            'telp' => 'nullable|string|max:15',
            'tmp_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:100',
            'tgl_masuk' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'nullable|email|unique:users,email,' . ($user ? $user->id : 'NULL'),
            'password' => 'nullable|string|min:8|confirmed',

            // Validasi untuk data orang tua
            'nama_ayah' => 'nullable|string|max:50',
            'telp_ayah' => 'nullable|string|max:15',
            'pekerjaan_ayah' => 'nullable|string|max:50',
            'penghasilan_ayah' => 'nullable|numeric',
            'nama_ibu' => 'nullable|string|max:50',
            'telp_ibu' => 'nullable|string|max:15',
            'pekerjaan_ibu' => 'nullable|string|max:50',
            'penghasilan_ibu' => 'nullable|numeric',
            'alamat_orang_tua' => 'nullable|string|max:100',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('foto')) {
                if ($siswa->foto) {
                    Storage::delete('public/' . $siswa->foto);
                }
                $fotoPath = $request->file('foto')->store('siswa_fotos', 'public');
                $siswa->foto = $fotoPath;
            }

            $siswa->update([
                'no_induk' => $request->no_induk,
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'jk' => $request->jk,
                'kelas_id' => $request->kelas_id,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'tgl_masuk' => $request->tgl_masuk,
                'foto' => $siswa->foto,
            ]);

            $user->name = $request->nama_siswa;
            $user->email = $request->email ?? 'siswa' . $request->no_induk . '@' . env('DOMAIN_EMDEFAULT', 'localemail.test');
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            if ($orangTua) {
                $orangTua->update([
                    'nama_ayah' => $request->nama_ayah,
                    'telp_ayah' => $request->telp_ayah,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'penghasilan_ayah' => $request->penghasilan_ayah,
                    'nama_ibu' => $request->nama_ibu,
                    'telp_ibu' => $request->telp_ibu,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,
                    'penghasilan_ibu' => $request->penghasilan_ibu,
                    'alamat_orang_tua' => $request->alamat_orang_tua,
                ]);
            }

            DB::commit();
            return redirect()->route('siswa.edit', $id)->with('success', 'Data siswa dan orang tua berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('siswa.edit', $id)->with('error', 'Gagal memperbarui data siswa dan orang tua.');
        }
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        DB::beginTransaction();

        try {
            $siswa->delete();

            if ($user) {
                $user->delete();
            }

            DB::commit();

            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data siswa.');
        }
    }
}
