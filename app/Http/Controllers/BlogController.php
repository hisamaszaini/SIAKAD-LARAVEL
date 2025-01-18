<?php

namespace App\Http\Controllers;

use App\Models\BlogKategori;
use App\Models\BlogPost;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PDO;

class BlogController extends Controller
{
    public function index()
    {
        $counts = DB::select("
    SELECT 
    (SELECT COUNT(*) FROM guru) as guru_count,
    (SELECT COUNT(*) FROM kelas) as kelas_count,
    (SELECT COUNT(*) FROM siswa) as siswa_count
");

        $guruCount = $counts[0]->guru_count;
        $kelasCount = $counts[0]->kelas_count;
        $siswaCount = $counts[0]->siswa_count;
        $settings = Settings::first();
        $title = $settings->lembaga_nama . " | IT Iman Taqwa";
        $posts = BlogPost::where('kategori_id', '2')->orWhere('kategori_id', '3')
                ->orderBy('id', 'desc')->take(3)->get();
        return view('pages.blog.index', compact('title', 'posts', 'settings', 'guruCount', 'kelasCount', 'siswaCount'));
    }

    public function posts()
    {
        $settings = Settings::first();
        $title = "Blog " . $settings->lembaga_nama;
        $posts = BlogPost::orderBy('id', 'desc')->paginate(8);
        $categories = BlogKategori::all();

        return view('pages.blog.posts', compact('title', 'posts', 'categories', 'settings'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->first();
        if (!$post) {
            return redirect()->route('blog.index');
        }

        $latest = BlogPost::latest()->limit(12)->get();
        $settings = Settings::first();
        $kategori = BlogKategori::where('id', $post->kategori_id)->first();
        $title = $post->title . " | " . $settings->lembaga_nama;
        return view('pages.blog.post', compact('title', 'post', 'kategori', 'settings', 'latest'));
    }

    public function kategoris($slug)
    {
        $kategori = BlogKategori::where('slug', $slug)->first();
        if (!$kategori) {
            return redirect()->route('blog.index');
        }

        $settings = Settings::first();
        $posts = BlogPost::where('kategori_id', $kategori->id)->orderBy('id')->paginate(8);
        $title = "Kategori " . $kategori->nama  . " | " . $settings->lembaga_nama;
        return view('pages.blog.kategori', compact('title', 'posts', 'kategori', 'settings'));
    }
}
