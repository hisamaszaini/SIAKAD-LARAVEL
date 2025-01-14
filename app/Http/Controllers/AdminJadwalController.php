<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Hari;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Ruang;
use App\Models\Guru;
use App\Models\JamPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminJadwalController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');

        if ($cari) {
            $datas = Jadwal::whereHas('mapel', function ($query) use ($cari) {
                $query->where('nama', 'like', '%' . $cari . '%');
            })->paginate(config('app.pagination'));
        } else {
            $datas = Jadwal::with(['kelas', 'mapel', 'ruang', 'guru', 'jamPelajaran', 'hari'])
                ->orderBy('hari_id', 'asc')
                ->orderBy('kelas_id', 'asc')
                ->orderBy('jam_pelajaran_id', 'asc')
                ->paginate(config('app.pagination'));
        }

        $pages = "jadwal";
        $title = "Daftar Jadwal";

        return view('pages.admin.jadwal.index', compact('authSam', 'datas', 'pages', 'title', 'cari'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $pages = "jadwal";
        $title = "Tambah Jadwal";
        $kelas = Kelas::orderBy("nama", "asc")->get();
        $mapel = Mapel::orderBy("nama", "asc")->get();
        $ruang = Ruang::orderBy("nama", "asc")->get();
        $guru = Guru::orderBy("nama", "asc")->get();
        $jamPelajaran = JamPelajaran::orderBy("jam_mulai", "asc")->get();
        $hari = Hari::all();

        return view('pages.admin.jadwal.create', compact('authSam', 'pages', 'title', 'kelas', 'mapel', 'ruang', 'guru', 'jamPelajaran', 'hari'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapel,id',
            'ruang_id' => 'required|exists:ruang,id',
            'guru_id' => 'required|exists:guru,id',
            'jam_pelajaran_id' => 'required|exists:jam_pelajaran,id',
            'hari_id' => 'required|exists:hari,id',
            'semester' => 'nullable|string|max:50',
            'tahun_ajaran' => 'nullable|digits:4',
        ]);

        DB::beginTransaction();

        try {
            Jadwal::create($request->all());

            DB::commit();
            session()->flash('success', 'Jadwal berhasil ditambahkan.');
            return redirect()->route('jadwal.index');
        } catch (\Exception $e) {
            DB::rollback();
            // \Log::error('Gagal menambahkan data jadwal: ' . $e->getMessage(), [
            //     'request' => $request->all(),
            // ]);
            session()->flash('error', 'Gagal menambahkan jadwal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $jadwal = Jadwal::findOrFail($id);
        $pages = "jadwal";
        $title = "Edit Jadwal";
        $kelas = Kelas::orderBy("nama", "asc")->get();
        $mapel = Mapel::orderBy("nama", "asc")->get();
        $ruang = Ruang::orderBy("nama", "asc")->get();
        $guru = Guru::orderBy("nama", "asc")->get();
        $jamPelajaran = JamPelajaran::orderBy("jam_mulai", "asc")->get();
        $hari = Hari::all();

        return view('pages.admin.jadwal.edit', compact('authSam', 'jadwal', 'pages', 'title', 'kelas', 'mapel', 'ruang', 'guru', 'jamPelajaran', 'hari'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapel,id',
            'ruang_id' => 'required|exists:ruang,id',
            'guru_id' => 'required|exists:guru,id',
            'jam_pelajaran_id' => 'required|exists:jam_pelajaran,id',
            'hari_id' => 'required|exists:hari,id',
            'semester' => 'nullable|string|max:50',
            'tahun_ajaran' => 'nullable|digits:4',
        ]);

        DB::beginTransaction();

        try {
            $jadwal->update($request->all());

            DB::commit();
            return redirect()->route('jadwal.edit', $id)->with('success', 'Jadwal berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui jadwal: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        DB::beginTransaction();

        try {
            $jadwal->delete();

            DB::commit();
            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus jadwal: ' . $e->getMessage());
        }
    }

    public function cari(Request $request)
    {
        $authSam = Auth::user();
        $title = "Cari";
        $pages = "jadwal";
        $cari = $request->get('cari');

        $datas = Jadwal::whereHas('mapel', function ($query) use ($cari) {
            $query->where('nama', 'like', '%' . $cari . '%');
        })->paginate(config('app.pagination'));

        return view('pages.admin.jadwal.index', compact('authSam', 'datas', 'cari', 'title', 'pages'));
    }
}
