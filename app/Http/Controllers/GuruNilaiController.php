<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GuruNilaiController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $guru = $authSam->guru;
        $kelasId = $request->get('kelas_id');
        $query = Jadwal::where('guru_id', $guru->id);

        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        }
        $datas = $query->paginate(config('app.pagination'));
        $kelasIds = $datas->pluck('kelas_id');
        $kelas = Kelas::all();
        $pages = "nilai";
        $title = "Nilai Siswa";
        return view('pages.guru.nilai.index', compact('authSam', 'pages', 'title', 'datas', 'kelas'));
    }

    public function createDeskripsi($jadwal_id)
    {
        $authSam = Auth::user();
        $guru = $authSam->guru;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('guru_id', $guru->id)->first();

        if (!$jadwal) {
            return redirect()->route('guru.nilai.index')->with('error', 'Jadwal tidak ditemukan');
        }

        $kelas = Kelas::find($jadwal->kelas_id);
        $mapel = Mapel::find($jadwal->mapel_id);
        $nilai = Nilai::where('jadwal_id', $jadwal_id)->first();

        $deskripsi = $nilai ? $nilai->toArray() : [];
        $deskripsi['deskripsi_a'] = $deskripsi['deskripsi_a'] ?? "";
        $deskripsi['deskripsi_b'] = $deskripsi['deskripsi_b'] ?? "";
        $deskripsi['deskripsi_c'] = $deskripsi['deskripsi_c'] ?? "";
        $deskripsi['deskripsi_d'] = $deskripsi['deskripsi_d'] ?? "";
        
        $pages = "nilai";
        $title = "Perbarui Deskripsi Nilai";
        return view('pages.guru.nilai.deskripsi', compact('authSam', 'guru', 'kelas', 'mapel', 'nilai', 'deskripsi', 'pages', 'title'));
    }

    public function storeDeskripsi(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapel,id',
            'deskripsi_a' => 'required|string',
            'deskripsi_b' => 'required|string',
            'deskripsi_c' => 'required|string',
            'deskripsi_d' => 'required|string',
        ]);

        $id_guru = Auth::user()->guru->id;
        
        $jadwal = Jadwal::where('guru_id', $id_guru)
            ->where('mapel_id', $request->mapel_id)
            ->where('kelas_id', $request->kelas_id)->first();

        if (!$jadwal) {
            return redirect()->route('guru.nilai.index')->with('error', 'Anda tidak mengajar kelas ini');
        }

        Nilai::updateOrCreate(
            [
                'guru_id' => $id_guru,
                'mapel_id' => $request->mapel_id,
                'jadwal_id' => $jadwal->id,
            ],
            [
                'deskripsi_a' => $request->deskripsi_a,
                'deskripsi_b' => $request->deskripsi_b,
                'deskripsi_c' => $request->deskripsi_c,
                'deskripsi_d' => $request->deskripsi_d,
            ]
        );

        return redirect()->route('guru.nilai.index')->with('success', 'Deskripsi nilai berhasil disimpan');
    }
}
