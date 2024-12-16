<?php 

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminKelasController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');

        if ($cari) {
            // Mengambil kelas berdasarkan nama kelas atau nama guru
            $datas = Kelas::where('nama_kls', 'like', '%' . $cari . '%')
                ->orWhereHas('guru', function ($query) use ($cari) {
                    $query->where('nama_guru', 'like', '%' . $cari . '%');
                })
                ->with('guru')->orderBy("nama_kls", "asc")
                ->paginate(config('app.pagination'));
        } else {
            $datas = Kelas::with('guru')->paginate(config('app.pagination'));
        }

        $pages = "kelas";
        $title = "Daftar Kelas";

        return view('pages.admin.kelas.index', compact('authSam', 'datas', 'pages', 'title', 'cari'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $gurus = Guru::all();
        $pages = "kelas";
        $title = "Tambah Kelas";
        return view('pages.admin.kelas.create', compact('authSam', 'gurus', 'pages', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:10',
            'tingkat' => 'required|string|max:2',
            'guru_id' => 'nullable|exists:guru,id',
        ]);

        DB::beginTransaction();

        try {
            Kelas::create([
                'nama_kls' => $request->nama_kelas,
                'tingkat' => $request->tingkat,
                'guru_id' => $request->guru_id,
            ]);

            DB::commit();

            session()->flash('success', 'Data kelas berhasil ditambahkan.');
            return redirect()->route('kelas.index');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Gagal menambahkan data KELAS: ' . $e->getMessage(), [
                'request' => $request->all(),
            ]);
            session()->flash('error', 'Gagal menambahkan data kelas: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::all(); // Ambil semua guru untuk dropdown
        $pages = "kelas";
        $title = "Edit Data Kelas";

        return view('pages.admin.kelas.edit', compact('authSam', 'kelas', 'gurus', 'pages', 'title'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:10',
            'tingkat' => 'required|string|max:2',
            'guru_id' => 'nullable|exists:guru,id',
        ]);

        DB::beginTransaction();

        try {
            $kelas->update([
                'nama_kls' => $request->nama_kelas,
                'tingkat' => $request->tingkat,
                'guru_id' => $request->guru_id,
            ]);

            DB::commit();

            return redirect()->route('kelas.edit', $id)->with('success', 'Data kelas berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui data kelas: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        DB::beginTransaction();

        try {
            $kelas->delete();

            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data kelas: ' . $e->getMessage());
        }
    }

    public function cari(Request $request)
    {
        $authSam = Auth::user();
        $title = "Cari";
        $pages = "kelas";
        $cari = $request->get('cari');

        $datas = Kelas::where('nama_kls', 'like', '%' . $cari . '%')
            ->orWhereHas('guru', function ($query) use ($cari) {
                $query->where('nama_guru', 'like', '%' . $cari . '%');
            })
            ->with('guru')
            ->paginate(config('app.pagination'));

        return view('pages.admin.kelas.index', compact('authSam', 'datas', 'cari', 'title', 'pages'));
    }

    public function multidel(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:kelas,id',
        ]);

        $ids = $request->input('ids');

        DB::beginTransaction();
        try {
            Kelas::whereIn('id', $ids)->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Kelas berhasil dihapus!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data kelas.'], 500);
        }
    }
}
