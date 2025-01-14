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
            $query->where('nama', 'like', '%' . $cari . '%');
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
            'foto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:1024',
                'dimensions:min_width=300,min_height=300'
            ],
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
        ], [
            'foto.required' => 'Foto harus diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 1MB',
            'foto.dimensions' => 'Dimensi foto tidak sesuai (min: 300x300)'
        ]);

        DB::beginTransaction();

        try {
            $password = $request->filled('password') ? bcrypt($request->password) : bcrypt(env('GURU_PASSDEFAULT', '12345678'));

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $extension = $request->file('foto')->getClientOriginalExtension();
                $newFileName = time() . $request->nip . '.' . $extension;

                $fotoPath = $request->file('foto')->storeAs('guru_fotos', $newFileName, 'public');
            }

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => $password,
                'role' => 'Guru',
                'profile_photo_path' => $fotoPath,
            ]);

            Guru::create([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'email' => $request->email,
                'user_id' => $user->id,
                'pendidikan' => $request->pendidikan_terakhir,
                'jabatan' => $request->jabatan,
                'tgl_lahir' => $request->tgl_lahir,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_masuk' => $request->tgl_masuk,
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
    
        $request->validate([
            'foto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:1024',
                'dimensions:min_width=300,min_height=300'
            ],
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
        ], [
            'foto.required' => 'Foto harus diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 1MB',
            'foto.dimensions' => 'Dimensi foto tidak sesuai (min: 300x300)'
        ]);
    
        DB::beginTransaction();
    
        try {

            $fotoPath = $guru->foto;

            if ($request->hasFile('foto')) {
                if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                    Storage::disk('public')->delete($guru->foto);
                }
                
                $extension = $request->file('foto')->getClientOriginalExtension();
                $newFileName = time() . $guru->id . '.' . $extension;
                $fotoPath = $request->file('foto')->storeAs('guru_fotos', $newFileName, 'public');
            }
    
            $guru->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'pendidikan' => $request->pendidikan_terakhir,
                'jabatan' => $request->jabatan,
                'tgl_lahir' => $request->tgl_lahir,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_masuk' => $request->tgl_masuk,
                'gelar' => $request->gelar,
                'foto' => $guru->foto,
            ]);
    
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->profile_photo_path = $fotoPath;

            $user->save();
    
            DB::commit();
    
            return redirect()->route('guru.edit', ['id' => $guru->id])->with('success', 'Guru berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
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
        $datas = Guru::where('nama', 'like', '%' . $cari . '%')
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
