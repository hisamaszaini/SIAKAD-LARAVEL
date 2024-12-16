<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminGuruController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');

        $query = Guru::with('user')->select('guru.*');

        if ($cari) {
            $query->where('nama_guru', 'like', '%' . $cari . '%');
        }

        $datas = $query->paginate(config('app.pagination'));

        $pages = "guru";
        $title = "Daftar Guru";

        return view('pages.admin.guru.index', compact('authSam', 'datas', 'pages', 'title', 'cari'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $pages = "guru";
        $title = "Tambah Guru";
        return view('pages.admin.guru.create', compact('authSam', 'pages', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:30|unique:guru,nip',
            'nama' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'alamat' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:8|confirmed',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'jabatan' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'tmp_lahir' => 'nullable|string|max:50',
            'tgl_masuk' => 'nullable|date',
            'gelar' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $password = $request->filled('password') ? bcrypt($request->password) : bcrypt(env('GURU_PASSDEFAULT', '12345678'));

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => $password,
                'role' => 'Guru',
            ]);

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('guru_fotos', 'public');
            }

            Guru::create([
                'nip' => $request->nip,
                'nama_guru' => $request->nama,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'email' => $request->email,
                'user_id' => $user->id,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'jabatan' => $request->jabatan,
                'tgl_lahir' => $request->tgl_lahir,
                'tmp_lahir' => $request->tmp_lahir,
                'tanggal_masuk' => $request->tgl_masuk,
                'gelar' => $request->gelar,
                'foto' => $fotoPath,
            ]);

            DB::commit();

            session()->flash('success', 'Data guru berhasil ditambahkan.');
            return redirect()->route('guru');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Gagal menambahkan data guru: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $pages = "guru";
        $title = "Edit Data Guru";
        $guru = Guru::findOrFail($id);
        return view('pages.admin.guru.edit', compact('authSam', 'guru', 'pages', 'title'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $user = $guru->user;
    
        // Log data request untuk debugging
        \Log::info('Data request untuk update guru:', $request->all());
    
        $request->validate([
            'nip' => 'required|string|max:30|unique:guru,nip,' . $guru->id,
            'nama' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'alamat' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'jabatan' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'tmp_lahir' => 'nullable|string|max:50',
            'tgl_masuk' => 'nullable|date',
            'gelar' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        DB::beginTransaction();
    
        try {
            if ($request->hasFile('foto')) {
                if ($guru->foto) {
                    Storage::delete('public/' . $guru->foto);
                }
    
                $extension = $request->file('foto')->getClientOriginalExtension();
                $newFileName = time() . $guru->id . '.' . $extension;
                $guru->foto = $request->file('foto')->storeAs('guru_fotos', $newFileName, 'public');
            }
    
            $guru->update([
                'nip' => $request->nip,
                'nama_guru' => $request->nama,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'jabatan' => $request->jabatan,
                'tgl_lahir' => $request->tgl_lahir,
                'tmp_lahir' => $request->tmp_lahir,
                'tanggal_masuk' => $request->tgl_masuk,
                'gelar' => $request->gelar,
                'foto' => $guru->foto,
            ]);
    
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->save();
    
            DB::commit();
    
            return redirect()->route('guru.edit', ['id' => $guru->id])->with('success', 'Guru berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            
            // Log error dengan detail
            \Log::error('Gagal memperbarui data guru: ' . $e->getMessage(), [
                'request' => $request->all(),
                'guru_id' => $guru->id,
            ]);
    
            return redirect()->route('guru.edit', ['id' => $guru->id])->with('error', 'Gagal memperbarui data guru: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $user = $guru->user;

        DB::beginTransaction();

        try {
            $guru->delete();

            if ($user) {
                $user->delete();
            }

            DB::commit();

            return redirect()->route('guru.index')->with('success', 'Guru dan pengguna berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data guru dan pengguna.');
        }
    }

    public function cari(Request $request)
    {
        $authSam = Auth::user();
        $title = "Cari";
        $pages = "guru";
        $cari = $request->get('cari');
        $datas = Guru::where('nama_guru', 'like', '%' . $cari . '%')
            ->join('users', 'guru.user_id', '=', 'users.id')
            ->select('guru.*', 'users.email')
            ->paginate(config('app.pagination'));

        return view('pages.admin.guru.index', compact('authSam', 'datas', 'cari', 'title', 'pages'));
    }

    public function multidel(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:guru,id',
        ]);

        $ids = $request->input('ids');

        DB::beginTransaction();
        try {
            $gurus = Guru::whereIn('id', $ids)->get();

            foreach ($gurus as $guru) {
                if ($guru->user) {
                    $guru->user->delete();
                }
                $guru->delete();
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Guru dan pengguna berhasil dihapus!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data guru dan pengguna.'], 500);
        }
    }
}
