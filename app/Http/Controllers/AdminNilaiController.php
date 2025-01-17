<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Nilai;
use App\Models\Rapot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminNilaiController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $kelasId = $request->get('kelas_id');
        $guruId = $request->get('guru_id');
    
        $query = Jadwal::query();
    
        if ($guruId) {
            $query->where('guru_id', $guruId);
        }
    
        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        }
    
        $datas = $query->paginate(config('app.pagination'));
        $kelas = Kelas::all();
        $guru = Guru::all();
        $pages = "nilai";
        $title = "Nilai Siswa";
    
        return view('pages.admin.nilai.index', compact('authSam', 'pages', 'title', 'datas', 'kelas', 'guru'));
    }

    public function view($jadwal_id, $guru_id){
        $authSam = Auth::user();
        $jadwal = Jadwal::where('id', $jadwal_id)->where('guru_id', $guru_id)->first();

        if (!$jadwal) {
            return redirect()->route('guru.nilai.index')->with('error', 'Jadwal tidak ditemukan');
        }

        $kelas = Kelas::find($jadwal->kelas_id);
        $mapel = Mapel::find($jadwal->mapel_id);
        $siswa = $kelas->siswa;
        $guru = Guru::find($guru_id);

        $rapot = Rapot::where('kelas_id', $kelas->id)
            ->where('guru_id', $guru_id)
            ->where('mapel_id', $mapel->id)
            ->get()
            ->keyBy('siswa_id');

        $pages = "nilai";
        $title = "Lihat Nilai " . $mapel->nama . " Kelas " . $kelas->nama;
        return view('pages.admin.nilai.view', compact('authSam', 'guru', 'kelas', 'mapel', 'rapot', 'siswa', 'pages', 'title'));
    }

}
