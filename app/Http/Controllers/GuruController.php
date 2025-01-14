<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function biodata()
    {
        $title = "Biodata";
        $pages = "biodata";
        $authSam = Auth::user();
        $guru = $authSam->guru;

        if ($guru->tgl_lahir) {
            $guru->tgl_lahir = Carbon::parse($guru->tgl_lahir);
        }
        if ($guru->tgl_masuk) {
            $guru->tgl_masuk = Carbon::parse($guru->tgl_masuk);
        }

        return view('pages.guru.biodata', compact('title', 'pages', 'authSam', 'guru'));
    }

    public function editBiodata()
    {
        $title = "Edit Biodata";
        $pages = "biodata";
        $authSam = Auth::user();
        $guru = $authSam->guru;

        return view('pages.guru.editbio', compact('title', 'pages', 'authSam', 'guru'));
    }

    public function updateBiodata(Request $request){
        $guru = Auth::user()->guru;
        $user = $guru->user;
        
        $request->validate([
            'foto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:1024',
                'dimensions:min_width=300,min_height=300'
            ],
            'nama' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'alamat' => 'required|string|max:100',
            'telp' => 'required|string|max:15',
            'pendidikan_terakhir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:50',
            'gelar' => 'nullable|string|max:50',
        ], [
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 1MB',
            'foto.dimensions' => 'Dimensi foto tidak sesuai (min: 300x300)'
        ]);

        DB::beginTransaction();

        try {
            $fotoPath = null;
            if ($request->hasFile('foto')) {

                $extension = $request->file('foto')->getClientOriginalExtension();
                $newFileName = time() . $user->id . '.' . $extension;
                $fotoPath = $request->file('foto')->storeAs('guru_fotos', $newFileName, 'public');
            }

            $guru->update([
                'nama' => $request->nama,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'pendidikan' => $request->pendidikan_terakhir,
                'tgl_lahir' => $request->tanggal_lahir,
                'tmp_lahir' => $request->tempat_lahir,
                'gelar' => $request->gelar,
                'foto' => $fotoPath,
            ]);

            $user->name = $request->nama;
            $user->profile_photo_path = $fotoPath;
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah biodata!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengubah biodata!');
        }
    }

    public function lihatJadwal()
    {
        $title = "Jadwal Mengajar";
        $pages = "jadwal";
        $authSam = Auth::user();
        $guru = $authSam->guru;
        $datas = Jadwal::with('kelas', 'mapel', 'ruang', 'JamPelajaran', 'hari')->where('guru_id', $guru->id)->get();

        return view('pages.guru.lihat-jadwal', compact('title', 'pages', 'datas', 'authSam'));
    }
}
