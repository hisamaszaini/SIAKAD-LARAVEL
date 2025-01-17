<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Pengumuman;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $pages = 'dashboard';
        $authSam = Auth::user();
        $guru = Guru::get();
        $kelas = Kelas::get();
        $mapel = Mapel::get();
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->first();
        $laki = Siswa::where('jk', 'L')->count();
        $perempuan = Siswa::where('jk', '!=', 'P')->count();

        if (($authSam->role) == 'Admin') {

            return view('pages.admin.dashboard', compact('title', 'pages', 'authSam', 'guru', 'kelas', 'mapel', 'pengumuman', 'laki', 'perempuan'));
        } else if (($authSam->role) == 'Guru') {
            $guru_id = Guru::where('user_id', $authSam->id)->pluck('id');
            $jadwal = Jadwal::where('guru_id', $guru_id)->get();
            return view('pages.guru.dashboard', compact('title', 'pages', 'authSam', 'jadwal', 'laki', 'perempuan', 'guru_id', 'pengumuman'));
        } else if (($authSam->role) == 'Siswa') {
            $siswa = Siswa::with('kelas')->where('user_id', $authSam->id)->first();
            if (!$siswa) {
                abort(404, 'Data siswa tidak ditemukan');
            }
            $id_kelas = $siswa->kelas->id;

            $jadwal = Jadwal::with(['mapel', 'ruang', 'guru', 'jamPelajaran', 'hari'])
                ->where('kelas_id', $id_kelas)
                ->orderBy('hari_id', 'asc')
                ->orderBy('jam_pelajaran_id', 'asc')
                ->get();

            return view('pages.siswa.dashboard', compact('title', 'pages', 'authSam', 'siswa', 'jadwal', 'pengumuman'));
        } else {
            //return view('pages.admin.dashboard.index', compact('pages', 'mapel', 'laki', 'perempuan'));
            echo "Role Tidak Ada!";
        }
    }

    public function chartData()
    {
        $kelas = Kelas::withCount('siswa')->get();

        $data = [
            'labels' => $kelas->pluck('nama'),
            'data' => $kelas->pluck('siswa_count'),
        ];

        return response()->json($data);
    }
}
