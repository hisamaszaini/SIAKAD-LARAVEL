<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Penagihan;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Exports\TagihanPenagihanExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminTagihanController extends Controller
{

    public function index(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');

        if ($cari) {
            $datas = Tagihan::where('nama', 'like', '%' . $cari . '%')
                ->paginate(config('app.pagination'));
        } else {
            $datas = Tagihan::orderBy('created_at', 'desc')->paginate(config('app.pagination'));
        }

        $pages = "tagihan";
        $title = "Daftar Tagihan";

        return view('pages.admin.tagihan.index', compact('authSam', 'datas', 'pages', 'title', 'cari'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $pages = "tagihan";
        $title = "Tambah Tagihan";
        return view('pages.admin.tagihan.create', compact('authSam', 'pages', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:30',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|max:50',
            'tingkatan' => 'required|numeric|min:1|max:12',
            'semester' => 'required|numeric|min:1|max:2',
            'tanggal_tagihan' => 'required|date',
            'tanggal_tempo' => 'required|date|after_or_equal:tanggal_tagihan',
        ]);

        $tagihan = Tagihan::create([
            'nama' => $request->nama,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'tingkatan' => $request->tingkatan,
            'semester' => $request->semester,
            'tgl_tagihan' => $request->tanggal_tagihan,
            'tgl_tempo' => $request->tanggal_tempo,
        ]);

        if ($tagihan) {
            return redirect()->route('tagihan.index')
                ->with('success', 'Tagihan berhasil dibuat.');
        } else {
            return redirect()->back()
                ->with('error', 'Gagal membuat tagihan.')
                ->withInput();
        }
    }

    public function createPenagihan(Request $request, $tagihanId)
    {
        $tagihan = Tagihan::find($tagihanId);
        if (!$tagihan) {
            return redirect()->back()->with('error', 'Tagihan tidak ditemukan.');
        }

        $tingkatan = $tagihan->tingkatan;
        $kelasIds = Kelas::where('tingkat', $tingkatan)->pluck('id');
        $siswaIds = Siswa::whereIn('kelas_id', $kelasIds)->pluck('id');

        if ($siswaIds->isNotEmpty()) {
            foreach ($siswaIds as $siswaId) {
                // Check if the Penagihan already exists
                $existingPenagihan = Penagihan::where('siswa_id', $siswaId)
                    ->where('tagihan_id', $tagihanId)
                    ->first();
                if (!$existingPenagihan) {
                    Penagihan::create([
                        'siswa_id' => $siswaId,
                        'tagihan_id' => $tagihanId,
                        'status' => 'Belum Dibayar',
                    ]);
                }
            }
        } else {
            return redirect()->back()->with('error', 'Tidak ada siswa yang ditagih');
        }

        return redirect()->route('tagihan.index')->with('success', 'Penagihan berhasil dibuat.');
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $tagihan = Tagihan::find($id);
        $pages = "tagihan";
        $title = "Edit Tagihan";

        return view('pages.admin.tagihan.edit', compact('authSam', 'tagihan', 'pages', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:30',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|max:50',
            'tingkatan' => 'required|numeric|min:1|max:12',
            'semester' => 'required|numeric|min:1|max:2',
            'tanggal_tagihan' => 'required|date',
            'tanggal_tempo' => 'required|date|after_or_equal:tanggal_tagihan',
        ]);

        $tagihan = Tagihan::find($id);

        if (!$tagihan) {
            return redirect()->back()->with('error', 'Tagihan tidak ditemukan.');
        }

        $tagihan->update([
            'nama' => $request->nama,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'tingkatan' => $request->tingkatan,
            'semester' => $request->semester,
            'tgl_tagihan' => $request->tanggal_tagihan,
            'tgl_tempo' => $request->tanggal_tempo,
        ]);

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $penagihan = Penagihan::find($id);

        if (!$penagihan) {
            return redirect()->back()->with('error', 'Penagihan tidak ditemukan.');
        }

        $penagihan->delete();

        return redirect()->route('tagihan.index')->with('success', 'Penagihan berhasil dihapus.');
    }

    public function daftarPenagihan(Request $request, $tagihanId)
    {
        $tagihan = Tagihan::find($tagihanId);
        if (!$tagihan) {
            return redirect()->back()->with('error', 'Tagihan tidak ditemukan.');
        }

        $penagihan = Penagihan::with('siswa')
            ->where('tagihan_id', $tagihanId)
            ->paginate(30);

        $authSam = Auth::user();
        $pages = "penagihan";
        $title = "Daftar Penagihan";

        return view('pages.admin.tagihan.daftarpenagihan', compact('authSam', 'pages', 'title', 'tagihan', 'penagihan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Belum Dibayar,Lunas',
        ]);

        $penagihan = Penagihan::findOrFail($id);
        $penagihan->status = $request->status;
        if ($request->status === 'Lunas') {
            $penagihan->tgl_dibayar = $request->tanggal_dibayar ?? now()->toDateString();
        }
        $penagihan->save();

        return response()->json(['success' => true]);
    }

    public function kwitansiPenagihan($penagihanId)
    {
        $penagihan = Penagihan::with(['siswa', 'tagihan'])->find($penagihanId);
        if (!$penagihan) {
            return redirect()->back()->with('error', 'Data penagihan tidak ditemukan.');
        }

        $title = "Kwitansi Pembayaran";
        return view('pages.admin.tagihan.kwitansi', compact('title', 'penagihan'));
    }

    public function export($tagihanId)
    {
        $tagihan = Tagihan::find($tagihanId);
        
        if (!$tagihan) {
            return redirect()->back()->with('error', 'Tagihan tidak ditemukan.');
        }

        return Excel::download(new TagihanPenagihanExport($tagihanId), 'tagihan_penagihan.xlsx');
    }
}
