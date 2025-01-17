<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminSettingController extends Controller
{
    public function index()
    {
        $authSam = Auth::user();
        $title = "Pengaturan SIAKAD";
        $pages = "settings";
        $settings = Settings::first();

        return view('pages.admin.settings.index', compact('authSam', 'title', 'pages', 'settings'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'app_nama' => 'required|string|max:255',
                'app_namapendek' => 'required|string|max:100',
                'pagination' => 'required|integer|min:8|max:40',
                'lembaga_nama' => 'required|string|max:255',
                'lembaga_jalan' => 'required|string|max:255',
                'lembaga_telp' => 'required|string|max:50',
                'lembaga_kota' => 'required|string|max:100',
                'nama_kepsek' => 'required|string|max:255',
                'nominaltagihan' => 'required|numeric|min:0',
                'semesteraktif' => 'required|in:1,2',
                'lembaga_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'sekolah_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            ]);
    
            $settings = Settings::firstOrCreate([]);
    
            if ($request->hasFile('lembaga_logo')) {
                if ($settings->lembaga_logo && Storage::disk('public')->exists($settings->lembaga_logo)) {
                    Storage::disk('public')->delete($settings->lembaga_logo);
                }
                
                $extension = $request->file('lembaga_logo')->getClientOriginalExtension();
                $lembagaLogoPath = 'logo/lembaga_logo.' . $extension;
                $request->file('lembaga_logo')->storeAs('logo', 'lembaga_logo.' . $extension, 'public');
                $settings->lembaga_logo = $lembagaLogoPath;
            }
    
            if ($request->hasFile('sekolah_logo')) {
                if ($settings->sekolah_logo && Storage::disk('public')->exists($settings->sekolah_logo)) {
                    Storage::disk('public')->delete($settings->sekolah_logo);
                }
                
                $extension = $request->file('sekolah_logo')->getClientOriginalExtension();
                $sekolahLogoPath = 'logo/sekolah_logo.' . $extension;
                $request->file('sekolah_logo')->storeAs('logo', 'sekolah_logo.' . $extension, 'public');
                $settings->sekolah_logo = $sekolahLogoPath;
            }
    
            $dataToFill = array_diff_key($validated, array_flip(['lembaga_logo', 'sekolah_logo']));
            $settings->fill($dataToFill);
            $settings->save();
    
            return redirect()->route('settings')->with('success', 'Pengaturan berhasil disimpan!');
        } catch (ValidationException $e) {
            return back()->with('error', 'Gagal memperbarui data pengaturan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pengaturan!');
        }
    }
}
