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
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{

    public function index(Request $request)
    {
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

        return view('pages.guru.absensi.index', compact('authSam', 'datas', 'tanggal', 'kelas_id', 'kelas', 'title', 'pages'));
    }


    public function create()
    {
        $authSam = Auth::user();
        $kelas = Kelas::all();
        $title = "Tambah Absensi";
        $pages = "absensi";

        return view('pages.guru.absensi.create', compact('authSam', 'kelas', 'title', 'pages'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
        ]);

        $guru = Guru::where('user_id', Auth::id())->first();

        DB::beginTransaction();

        try {
            Absensi::create([
                'kelas_id' => $request->kelas_id,
                'tanggal' => $request->tanggal,
                'guru_id' => $guru->id,
            ]);

            DB::commit();
            session()->flash('success', 'Absensi berhasil ditambahkan.');
            return redirect()->route('guru.absensi.index');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Gagal menambahkan absensi: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function createKehadiran($absensiId)
    {
        $authSam = Auth::user();
        $pages = "absensi";
        $title = "Isi Kehadiran Siswa";
        $absensi = Absensi::findOrFail($absensiId);
        $siswas = Siswa::where('kelas_id', $absensi->kelas_id)->get();
        $kehadiranData = Kehadiran::where('absensi_id', $absensiId)
        ->get(['siswa_id', 'status'])
        ->keyBy('siswa_id')
        ->map(function($item) {
            return $item->status;
        })
        ->toArray();
        
        return view('pages.guru.absensi.isikehadiran', compact('authSam', 'pages', 'title', 'absensi', 'siswas', 'kehadiranData'));
    }

    public function storeKehadiran(Request $request)
    {
        $authSam = Auth::user();
        $guruId = $authSam->guru->id;

        $request->validate([
            'absensi_id' => 'required|exists:absensi,id',
            'kehadiran' => 'required|array',
            'kehadiran.*' => 'in:1,2,3,4',
        ]);
    
        try {
            $absensi = Absensi::findOrFail($request->absensi_id);

            Kehadiran::where('absensi_id', $request->absensi_id)->delete();
    
            foreach ($request->kehadiran as $siswaId => $status) {
                if ($status) {
                    Kehadiran::create([
                        'siswa_id' => $siswaId,
                        'absensi_id' => $request->absensi_id,
                        'status' => (int)$status,
                    ]);
                }
            }

            $absensi->update_by = $guruId;
            $absensi->save();
    
            return redirect()->route('guru.absensi.isikehadiran', $request->absensi_id)->with('success', 'Kehadiran siswa berhasil ditambahkan.');
    
        } catch (\Exception $e) {
            // \Log::error('Gagal menambahkan data absensi: ' . $e->getMessage(), [
            //     'request' => $request->all(),
            // ]);
    
            return redirect()->route('guru.absensi.index')->with('error', 'Gagal menambahkan kehadiran siswa. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $absensi = Absensi::findOrFail($id);
        $guru = Guru::all();
        $kelas = Kelas::all();
        $title = "Edit Absensi";
        $pages = "absensi";

        return view('pages.guru.absensi.edit', compact('authSam', 'absensi', 'kelas', 'guru', 'title', 'pages'));
    }

    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'guru_id' => 'required|exists:guru,id',
        ]);

        DB::beginTransaction();

        try {
            $absensi->update([
                'kelas_id' => $request->kelas_id,
                'tanggal' => $request->tanggal,
                'guru_id' => $request->guru_id,
            ]);

            DB::commit();
            return redirect()->route('guru.absensi.edit', $id)->with('success', 'Absensi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui absensi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);

        DB::beginTransaction();

        try {
            $absensi->delete();
            DB::commit();
            return redirect()->route('guru.absensi.index')->with('success', 'Data absensi berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data absensi: ' . $e->getMessage());
        }
    }
}
