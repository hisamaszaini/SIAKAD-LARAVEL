<?php
namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAbsensiController extends Controller
{
    public function index(Request $request){
        $authSam = Auth::user();
        $tanggal = $request->get('tanggal');
        $kelas_id = $request->get('kelas_id');

        $datas = Absensi::with('kehadiran');

        if ($tanggal) {
            $datas->where('tanggal', $tanggal);
        }

        if ($kelas_id) {
            $datas->where('kelas_id', $kelas_id);
        }

        $datas = $datas->paginate(config('app.pagination'));

        $title = "Daftar Absensi";
        $pages = "absensi";
        $kelas = Kelas::all();

        return view('pages.admin.absensi.index', compact('authSam', 'datas', 'tanggal', 'kelas_id', 'kelas', 'title', 'pages'));
    }

    public function view($absensiId){
        $authSam = Auth::user();
        $absensi = Absensi::with('kehadiran')->find($absensiId);
        $siswas = Siswa::where('kelas_id', $absensi->kelas_id)->get();
        $kehadiranData = Kehadiran::where('absensi_id', $absensiId)
        ->get(['siswa_id', 'status'])
        ->keyBy('siswa_id')
        ->map(function ($item) {
            return $item->status_label;
        })->toArray();
        $title = "Detail Absensi";
        $pages = "absensi";

        return view('pages.admin.absensi.view', compact('authSam', 'absensi', 'siswas', 'kehadiranData', 'title', 'pages'));
    }

    public function cari(Request $request){
        $tanggal = $request->get('tanggal');
        $kelas_id = $request->get('kelas_id');

        return redirect()->route('admin.absensi.index', ['tanggal' => $tanggal, 'kelas_id' => $kelas_id]);
    }
}
