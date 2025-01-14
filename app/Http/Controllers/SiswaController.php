<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Rapot;
use App\Models\Penagihan;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{

    public function biodata()
    {
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

    public function editBiodata()
    {
        $title = "Edit Biodata";
        $pages = "biodata";
        $authSam = Auth::user();
        //$user = Auth::user();
        $siswa = $authSam->siswa;
        $orangTua = $siswa->orangTua()->first();

        return view('pages.siswa.editbio', compact('title', 'pages', 'authSam', 'siswa', 'orangTua'));
    }

    public function updateBiodata(Request $request)
    {
        $siswa = Auth::user()->siswa;
        $user = $siswa->user;
        $orangTua = $siswa->orangTua()->first();

        $request->validate([
            'foto' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:1024',
                'dimensions:min_width=300,min_height=300'
            ],
            'nisn' => 'nullable|string|max:30|unique:siswa,nisn,' . $siswa->id,
            'nama_siswa' => 'required|string|max:50',
            'jk' => 'required|in:L,P',
            'telp' => 'nullable|string|max:15',
            'tmp_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:100',
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
        ], [
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 1MB',
            'foto.dimensions' => 'Dimensi foto tidak sesuai (min: 300x300)'
        ]);

        DB::beginTransaction();

        try {
            $fotoPath = $siswa->foto;

            if ($request->hasFile('foto')) {
                if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                    Storage::disk('public')->delete($siswa->foto);
                }

                $extension = $request->file('foto')->getClientOriginalExtension();
                $newFileName = time() . $user->id . '.' . $extension;
                $fotoPath = $request->file('foto')->storeAs('siswa_fotos', $newFileName, 'public');
            }

            $siswa->update([
                'nisn' => $request->nisn,
                'nama' => $request->nama_siswa,
                'jk' => $request->jk,
                'telp' => $request->telp,
                'tmp_lahir' => $request->tmp_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'foto' => $fotoPath,
            ]);

            $user->name = $request->nama_siswa;
            $user->profile_photo_path = $fotoPath;
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
            dd($e, $newFileName);
            DB::rollback();
            return redirect()->route('siswa.editbio')->with('error', 'Gagal memperbarui data Anda.');
        }
    }

    public function lihatJadwal()
    {
        $title = "Lihat Jadwal";
        $pages = "jadwal";
        $authSam = Auth::user();
        $siswa = Auth::user()->siswa;
        $kelas = $siswa->kelas;
        $datas = Jadwal::with(['mapel', 'ruang', 'guru', 'jamPelajaran', 'hari'])
            ->where('kelas_id', $kelas->id)
            ->orderBy('hari_id', 'asc')
            ->orderBy('jam_pelajaran_id', 'asc')
            ->get();

        return view('pages.siswa.lihat-jadwal', compact('title', 'pages', 'authSam', 'siswa', 'kelas', 'datas'));
    }

    public function lihatKehadiran()
    {
        $title = "Lihat Kehadiran";
        $pages = "kehadiran";
        $authSam = Auth::user();
        $siswa = Auth::user()->siswa;
        $kelas = $siswa->kelas;
        $datas = $siswa->kehadiran()->with(['absensi'])->paginate(config('app.pagination'));
        return view('pages.siswa.lihat-kehadiran', compact('title', 'pages', 'authSam', 'siswa', 'kelas', 'datas'));
    }

    public function lihatRapot()
    {
        $title = "Lihat Rapot";
        $pages = "rapot";
        $authSam = Auth::user();
        $siswa = Auth::user()->siswa;
        $kelas = $siswa->kelas;
        $datas = $siswa->rapot()->with(['mapel', 'guru'])->get();

        return view('pages.siswa.lihat-rapot', compact('title', 'pages', 'authSam', 'siswa', 'kelas', 'datas'));
    }

    public function lihatTagihan()
    {
        $title = "Lihat Tagihan";
        $pages = "tagihan";
        $authSam = Auth::user();
        $siswa = $authSam->siswa;

        $tagihan = Penagihan::where('siswa_id', $siswa->id)
            ->with('tagihan')
            ->get();

        return view('pages.siswa.lihat-tagihan', compact('title', 'pages', 'authSam', 'siswa', 'tagihan'));
    }
}
