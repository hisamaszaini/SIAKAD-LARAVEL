<?php

namespace App\Http\Controllers;

use App\Models\BlogKategori;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use PDO;

class BlogController extends Controller
{
    public function index()
    {
        $title = "SMP Cendikia Ponorogo | IT Iman Taqwa";
        $posts = BlogPost::orderBy('id', 'desc')->take(3)->get();

        return view('pages.blog.index', compact('title', 'posts'));
    }

    public function posts()
    {
        $title = "Blog SMP Cendikia Ponorogo";
        $posts = BlogPost::orderBy('id', 'desc')->paginate(8);
        $categories = BlogKategori::all();

        return view('pages.blog.posts', compact('title', 'posts', 'categories'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->first();
        if (!$post) {
            return redirect()->route('blog.index');
        }

        $kategori = BlogKategori::where('id', $post->kategori_id)->first();
        $title = $post->title;
        return view('pages.blog.post', compact('title', 'post', 'kategori'));
    }

    public function kategoris($slug)
    {
        $kategori = BlogKategori::where('slug', $slug)->first();
        if (!$kategori) {
            return redirect()->route('blog.index');
        }
        $posts = BlogPost::where('kategori_id', $kategori->id)->orderBy('id')->paginate(8);
        $title = "Kategori " . $kategori->nama;
        return view('pages.blog.kategori', compact('title', 'posts', 'kategori'));
    }
}
