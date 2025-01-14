<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Rapot;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GuruRapotController extends Controller
{
    // public function index(Request $request)
    // {
    //     $authSam = Auth::user();
    //     $guru = Guru::where('id', $authSam->id)->first();

    //     $kelasId = $request->get('kelas_id');

    //     $query = Jadwal::where('guru_id', $guru->id);

    //     if ($kelasId) {
    //         $query->where('kelas_id', $kelasId);
    //     }
    //     $datas = $query->paginate(config('app.pagination'));
    //     $kelasIds = $datas->pluck('kelas_id');
    //     $kelas = Kelas::all();
    //     $pages = "nilai";
    //     $title = "Input Nilai Siswa";
    //     return view('pages.guru.rapot.index', compact('authSam', 'pages', 'title', 'datas', 'kelas'));
    // }

    public function createNilai($jadwal_id)
    {
        $authSam = Auth::user();
        $guru = $authSam->guru;
        $jadwal = Jadwal::where('id', $jadwal_id)->where('guru_id', $guru->id)->first();
        
        if (!$jadwal) {
            return redirect()->route('guru.nilai.index')->with('error', 'Anda tidak memiliki akses ke jadwal ini!');
        }

        $kelas = Kelas::find($jadwal->kelas_id);
        $mapel = Mapel::find($jadwal->mapel_id);
        $siswa = $kelas->siswa;
        $nilai = Nilai::where('jadwal_id', $jadwal_id)->first();
        $deskripsi = $nilai ? $nilai->toArray() : [];
        if (empty($deskripsi)) {
            return redirect()->route('guru.nilai.index')->with('error', 'Deskripsi predikat nilai belum diatur!');
        }

        $rapot = Rapot::where('kelas_id', $kelas->id)
            ->where('guru_id', $guru->id)
            ->where('mapel_id', $mapel->id)
            ->get()
            ->keyBy('siswa_id');

        $pages = "nilai";
        $title = "Isi Nilai Siswa";
        return view('pages.guru.nilai.isinilai', compact('authSam', 'guru', 'kelas', 'mapel', 'rapot', 'siswa', 'nilai', 'deskripsi', 'jadwal_id', 'pages', 'title'));
    }

    public function storeNilai(Request $request)
    {
        $authSam = Auth::user();
        $guru = $authSam->guru;
        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwal,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapel,id',
            'guru_id' => 'required|exists:guru,id',
            'siswa_id' => 'required|array',
            'siswa_id.*' => 'exists:siswa,id',
            'p_nilai' => 'required|array',
            'p_nilai.*' => 'numeric|min:0|max:100',
            'k_nilai' => 'required|array',
            'k_nilai.*' => 'numeric|min:0|max:100',
            'p_predikat' => 'nullable|array',
            'k_predikat' => 'nullable|array',
        ]);

        $jadwalId = $validated['jadwal_id'];
        $kelasId = $validated['kelas_id'];
        $mapelId = $validated['mapel_id'];
        $siswaIds = $validated['siswa_id'];
        $pNilai = $validated['p_nilai'];
        $kNilai = $validated['k_nilai'];
        $pPredikatInput = $validated['p_predikat'] ?? [];
        $kPredikatInput = $validated['k_predikat'] ?? [];

        $nilai = Nilai::where('jadwal_id', $jadwalId)->first();

        foreach ($siswaIds as $index => $siswaId) {
            $pengetahuanNilai = $pNilai[$index] ?? 0;
            $keterampilanNilai = $kNilai[$index] ?? 0;

            $pengetahuanPredikat = $pPredikatInput[$index] === 'auto'
                ? $nilai->getPredikat($pengetahuanNilai)
                : $pPredikatInput[$index];
            $pengetahuanDeskripsi = $nilai->getDeskripsi($pengetahuanPredikat);

            $keterampilanPredikat = $kPredikatInput[$index] === 'auto'
                ? $nilai->getPredikat($keterampilanNilai)
                : $kPredikatInput[$index];
            $keterampilanDeskripsi = str_replace('pengetahuan', 'keterampilan', $nilai->getDeskripsi($keterampilanPredikat));

            // \Log::info('Menyimpan nilai siswa', [
            //     'siswa_id' => $siswaId,
            //     'kelas_id' => $kelasId,
            //     'guru_id' => $guru->id,
            //     'mapel_id' => $mapelId,
            //     'p_nilai' => $pengetahuanNilai,
            //     'p_predikat' => $pengetahuanPredikat,
            //     'p_deskripsi' => $pengetahuanDeskripsi,
            //     'k_nilai' => $keterampilanNilai,
            //     'k_predikat' => $keterampilanPredikat,
            //     'k_deskripsi' => $keterampilanDeskripsi,
            // ]);

            Rapot::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'kelas_id' => $kelasId,
                    'guru_id' => $guru->id,
                    'mapel_id' => $mapelId,
                ],
                [
                    'p_nilai' => $pengetahuanNilai,
                    'p_predikat' => $pengetahuanPredikat,
                    'p_deskripsi' => $pengetahuanDeskripsi,
                    'k_nilai' => $keterampilanNilai,
                    'k_predikat' => $keterampilanPredikat,
                    'k_deskripsi' => $keterampilanDeskripsi,
                ]
            );
        }

        return back()->with('success', 'Nilai siswa berhasil disimpan!');
    }
}
