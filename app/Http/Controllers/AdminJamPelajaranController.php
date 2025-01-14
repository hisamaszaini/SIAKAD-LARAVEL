<?php
namespace App\Http\Controllers;

use App\Models\JamPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminJamPelajaranController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');

        if ($cari) {
            $datas = JamPelajaran::where('nama', 'like', '%' . $cari . '%')
                ->orderBy('urutan')
                ->paginate(config('app.pagination'));
        } else {
            $datas = JamPelajaran::orderBy('urutan')->paginate(config('app.pagination'));
        }

        $pages = "jampelajaran";
        $title = "Daftar Jam Pelajaran";

        return view('pages.admin.jampelajaran.index', compact('authSam', 'datas', 'pages', 'title', 'cari'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $pages = "jampelajaran";
        $title = "Tambah Jam Pelajaran";
        return view('pages.admin.jampelajaran.create', compact('authSam', 'pages', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jam' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'urutan' => 'required|integer|unique:jam_pelajaran,urutan',
        ]);

        DB::beginTransaction();

        try {
            JamPelajaran::create([
                'nama' => $request->nama_jam,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'urutan' => $request->urutan,
            ]);

            DB::commit();
            session()->flash('success', 'Data jam pelajaran berhasil ditambahkan.');
            return redirect()->route('jampelajaran.index');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Gagal menambahkan data jam pelajaran: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $jamPelajaran = JamPelajaran::findOrFail($id);
        $pages = "jampelajaran";
        $title = "Edit Jam Pelajaran";

        return view('pages.admin.jampelajaran.edit', compact('authSam', 'jamPelajaran', 'pages', 'title'));
    }

    public function update(Request $request, $id)
    {
        $jamPelajaran = JamPelajaran::findOrFail($id);

        $request->validate([
            'nama_jam' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'urutan' => 'required|integer|unique:jam_pelajaran,urutan,' . $jamPelajaran->id,
        ]);

        DB::beginTransaction();

        try {
            $jamPelajaran->update([
                'nama' => $request->nama_jam,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'urutan' => $request->urutan,
            ]);

            DB::commit();
            return redirect()->route('jampelajaran.edit', $id)->with('success', 'Jam pelajaran berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui data jam pelajaran: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $jamPelajaran = JamPelajaran::findOrFail($id);

        DB::beginTransaction();

        try {
            $jamPelajaran->delete();
            DB::commit();
            return redirect()->route('jampelajaran.index')->with('success', 'Data jam pelajaran berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data jam pelajaran: ' . $e->getMessage());
        }
    }

    public function cari(Request $request)
    {
        $authSam = Auth::user();
        $title = "Cari Jam Pelajaran";
        $pages = "jampelajaran";
        $cari = $request->get('cari');

        $datas = JamPelajaran::where('nama', 'like', '%' . $cari . '%')->orderBy('urutan')->paginate(config('app.pagination'));

        return view('pages.admin.jampelajaran.index', compact('authSam', 'datas', 'cari', 'title', 'pages'));
    }

    public function multidel(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:jampelajaran,id',
        ]);

        $ids = $request->input('ids');

        DB::beginTransaction();
        try {
            JamPelajaran::whereIn('id', $ids)->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Jam pelajaran berhasil dihapus!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data jam pelajaran.'], 500);
        }
    }
}
