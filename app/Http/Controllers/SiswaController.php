<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{

    public function biodata(){
        $title = "Biodata";
        $pages = "biodata";
        $authSam = Auth::user();
        $siswa = $authSam->siswa;
        $orangTua = $siswa->orangTua->first();

        if ($siswa->tgl_lahir) {
            $siswa->tgl_lahir = Carbon::parse($siswa->tgl_lahir);
        }
        if ($siswa->tgl_masuk) {
            $siswa->tgl_masuk = Carbon::parse($siswa->tgl_masuk);
        }

        return view('pages.siswa.biodata', compact('title', 'pages', 'authSam', 'siswa', 'orangTua'));
    }

    public function editBiodata(){
        $title = "Edit Biodata";
        $pages = "biodata";
        $authSam = Auth::user();
        $user = Auth::user();
        $siswa = $user->siswa;
        $orangTua = $siswa->orangTua()->first();

        return view('pages.siswa.editbio', compact('title', 'pages', 'authSam', 'user', 'siswa', 'orangTua'));
    }

    public function updateBiodata(Request $request)
    {
        $siswa = Auth::user()->siswa;
        $user = $siswa->user;
        $orangTua = $siswa->orangTua()->first();

        $request->validate([
            'nisn' => 'nullable|string|max:30|unique:siswa,nisn,' . $siswa->id,
            'nama_siswa' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'telp' => 'nullable|string|max:15',
            'tmp_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:users,email,' . $user->id,

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
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'jk' => $request->jk,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'foto' => $siswa->foto,
            ]);

            $user->name = $request->nama_siswa;
            $user->email = $request->email;
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
            return redirect()->route('siswa.editbio')->with('success', 'Data Anda berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('siswa.editbio')->with('error', 'Gagal memperbarui data Anda.');
        }
    }
}
