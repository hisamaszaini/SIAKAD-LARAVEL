<?php

namespace App\Http\Controllers;

use App\Models\Ruang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminRuangController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');

        if ($cari) {
            $datas = Ruang::where('nama', 'like', '%' . $cari . '%')
                ->paginate(config('app.pagination'));
        } else {
            $datas = Ruang::orderBy('nama', 'asc')->paginate(config('app.pagination'));
        }

        $pages = "ruang";
        $title = "Daftar Ruang";

        return view('pages.admin.ruang.index', compact('authSam', 'datas', 'pages', 'title', 'cari'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $pages = "ruang";
        $title = "Tambah Ruang";
        return view('pages.admin.ruang.create', compact('authSam', 'pages', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruang' => 'required|string|max:255|unique:ruang,nama',
            'jenis' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            Ruang::create([
                'nama' => $request->nama_ruang,
                'jenis' => $request->jenis,
            ]);

            DB::commit();
            session()->flash('success', 'Data ruang berhasil ditambahkan.');
            return redirect()->route('ruang');
        } catch (\Exception $e) {
            DB::rollback();
            // \Log::error('Gagal menambahkan data RUANG: ' . $e->getMessage(), [
            //     'request' => $request->all(),
            // ]);
            session()->flash('error', 'Gagal menambahkan data ruang: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $ruang = Ruang::findOrFail($id);
        $pages = "ruang";
        $title = "Edit Data Ruang";

        return view('pages.admin.ruang.edit', compact('authSam', 'ruang', 'pages', 'title'));
    }

    public function update(Request $request, $id)
    {
        $ruang = Ruang::findOrFail($id);

        $request->validate([
            'nama_ruang' => 'required|string|max:255|unique:ruang,nama,' . $ruang->id,
            'jenis' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            $ruang->update([
                'nama' => $request->nama_ruang,
                'jenis' => $request->jenis,
            ]);

            DB::commit();
            return redirect()->route('ruang.edit', $id)->with('success', 'Ruang berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui data ruang: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $ruang = Ruang::findOrFail($id);

        DB::beginTransaction();

        try {
            $ruang->delete();
            DB::commit();
            return redirect()->route('ruang.index')->with('success', 'Data ruang berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data ruang: ' . $e->getMessage());
        }
    }

    public function cari(Request $request)
    {
        $authSam = Auth::user();
        $title = "Cari";
        $pages = "ruang";
        $cari = $request->get('cari');

        $datas = Ruang::where('nama', 'like', '%' . $cari . '%')->paginate(config('app.pagination'));

        return view('pages.admin.ruang.index', compact('authSam', 'datas', 'cari', 'title', 'pages'));
    }

    public function multidel(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:ruang,id',
        ]);

        $ids = $request->input('ids');

        DB::beginTransaction();
        try {
            Ruang::whereIn('id', $ids)->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Ruang berhasil dihapus!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data ruang.'], 500);
        }
    }
}
