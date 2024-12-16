<?php
namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Kategori;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminMapelController extends Controller
{
    public function index(Request $request)
    {
        $authSam = Auth::user();
        $title = "Daftar Mapel";
        $pages = "mapel";
        $cari = $request->get('cari', '');
        $datas = Mapel::where('nama_mapel', 'like', '%' . $cari . '%')->paginate(config('app.pagination'));
        return view('pages.admin.mapel.index', compact('authSam', 'datas', 'cari', 'title', 'pages'));
    }

    public function create()
    {
        $authSam = Auth::user();
        $kategori = Kategori::all();
        $pages = "mapel";
        $title = "Tambah Mapel";
        return view('pages.admin.mapel.create', compact('authSam', 'kategori', 'pages', 'title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required|string|max:12|unique:mapel,kode_mapel',
            'nama_mapel' => 'required|string|max:50',
            'kategori_id' => 'required|exists:kategori,id',
            'kkm' => 'required|integer|min:0|max:100',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('mapel.create')->withErrors($validator)->withInput();
        }
    
        Mapel::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kategori_id' => $request->kategori_id,
            'kkm' => $request->kkm,
        ]);
    
        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $authSam = Auth::user();
        $pages = "mapel";
        $title = "Tambah Mapel";
        $mapel = Mapel::findOrFail($id);
        $kategori = Kategori::all();
        return view('pages.admin.mapel.edit', compact('authSam', 'pages', 'title', 'mapel', 'kategori'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required|string|max:12|unique:mapel,kode_mapel,' . $id,
            'nama_mapel' => 'required|string|max:50',
            'kategori_id' => 'required|exists:kategori,id',
            'kkm' => 'required|integer|min:0',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('mapel.edit', $id)->withErrors($validator)->withInput();
        }
    
        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kategori_id' => $request->kategori_id,
            'kkm' => $request->kkm,
        ]);
    
        return redirect()->route('mapel.edit', $id)->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();
        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
