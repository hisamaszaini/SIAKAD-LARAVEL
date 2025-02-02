<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminKategoriController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');

        if ($cari) {
            $datas = Kategori::where('nama', 'like', '%' . $cari . '%')
                ->paginate(config('app.pagination'));
        } else {
            $datas = Kategori::orderBy('nama', 'asc')->paginate(config('app.pagination'));
        }

        $pages = "kategori";
        $title = "Daftar Kategori";

        return view('pages.admin.kategori.index', compact('authSam', 'datas', 'pages', 'title', 'cari'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $pages = "kategori";
        $title = "Tambah Kategori";
        return view('pages.admin.kategori.create', compact('authSam', 'pages', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:30|unique:kategori,nama',
        ]);

        DB::beginTransaction();        
        try {
            Kategori::create([
                'nama' => $request->nama,
            ]);

            DB::commit();
            return redirect()->route('kategori.index')->with("success", "Kategori berhasil ditambahkan!");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with("error", "Gagal menambahkan data kategori!");
        }
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $kategori = Kategori::findOrFail($id);
        $pages = "kategori";
        $title = "Edit Data Kategori";

        return view('pages.admin.kategori.edit', compact('authSam', 'kategori', 'pages', 'title'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:30|unique:kategori,nama,' . $kategori->id,
        ]);

        DB::beginTransaction();

        try {
            $kategori->update([
                'nama' => $request->nama,
            ]);

            DB::commit();
            return redirect()->route('kategori.edit', $id)->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui data kategori!');
        }
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        DB::beginTransaction();

        try {
            $kategori->delete();
            DB::commit();
            return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data kategori: ' . $e->getMessage());
        }
    }

    public function cari(Request $request)
    {
        $authSam = Auth::user();
        $title = "Cari";
        $pages = "kategori";
        $cari = $request->get('cari');

        $datas = Kategori::where('nama', 'like', '%' . $cari . '%')->paginate(config('app.pagination'));

        return view('pages.admin.kategori.index', compact('authSam', 'datas', 'cari', 'title', 'pages'));
    }

    public function multidel(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:kategori,id',
        ]);

        $ids = $request->input('ids');

        DB::beginTransaction();
        try {
            Kategori::whereIn('id', $ids)->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data kategori.'], 500);
        }
    }
}