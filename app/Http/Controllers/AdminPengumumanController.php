<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminPengumumanController extends Controller
{
    public function index()
    {
        $authSam = Auth::user();
        $title = "Daftar Pengumuman";
        $pages = "pengumuman";

        $cari = request()->get('cari');
        if ($cari) {
            $datas = Pengumuman::where('isi', 'like', '%' . $cari . '%')->paginate(config('app.pagination'));
        } else {
            $datas = Pengumuman::orderBy('created_at', 'desc')->paginate(config('app.pagination'));
        }

        return view('pages.admin.pengumuman.index', compact('authSam', 'datas', 'title', 'pages', 'cari'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $pages = "pengumuman";
        $title = "Tambah Pengumuman";
        return view('pages.admin.pengumuman.create', compact('authSam', 'pages', 'title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:50',
            'isi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengumuman.create')->withErrors($validator)->withInput();
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $pages = "pengumuman";
        $title = "Edit Pengumuman";
        $data = Pengumuman::findOrFail($id);
        return view('pages.admin.pengumuman.edit', compact('authSam', 'data', 'pages', 'title'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'isi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengumuman.edit', $id)->withErrors($validator)->withInput();
        }

        Pengumuman::findOrFail($id)->update([
            'isi' => $request->isi,
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Pengumuman::findOrFail($id)->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
    }

    public function cari(Request $request)
    {
        $authSam = Auth::user();
        $title = "Daftar Pengumuman";
        $pages = "pengumuman";
        $cari = $request->cari;
        $datas = Pengumuman::where('isi', 'like', '%' . $cari . '%')->paginate(config('app.pagination'));
        return view('pages.admin.pengumuman.index', compact('authSam', 'datas', 'title', 'pages', 'cari'));
    }
}
