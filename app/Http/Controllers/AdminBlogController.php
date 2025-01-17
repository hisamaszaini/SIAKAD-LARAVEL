<?php

namespace App\Http\Controllers;

use App\Models\BlogKategori;
use App\Models\BlogPost;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function blogListPost(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');
        if ($cari) {
            $posts = BlogPost::where('judul', 'like', '%' . $cari . '%')->get()
                ->paginate(config('app.pagination'));
        } else {
            $posts = BlogPost::orderBy('id', 'desc')->paginate(config('app.pagination'));
        }

        $title = 'Blog List';
        $pages = 'blogpost';
        return view('pages.admin.blog.listpost', compact('authSam', 'title', 'cari', 'pages', 'posts'));
    }

    public function blogCreatePost()
    {
        $authSam = Auth::user();
        $kategori = BlogKategori::all();
        $title = 'Create Blog Post';
        $pages = 'blogpost';
        return view('pages.admin.blog.createpost', compact('authSam', 'title', 'pages', 'kategori'));
    }

    public function blogStorePost(Request $request)
    {
        $authSam = Auth::user();

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'kategori_id' => 'nullable|exists:blog_kategori,id',
            'slug' => 'nullable|unique:blog_post,slug',
        ], [
            'title.max' => 'Title tidak boleh lebih dari 255 karakter.',
            'slug.unique' => 'Slug sudah digunakan.',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        $blogPost = BlogPost::create([
            'title' => $request->title,
            'slug' => $slug,
            'kategori_id' => $request->kategori_id ?? 1,
            'users_id' => $authSam->id,
            'content' => $request->content,
            'image' => $this->uploadImage($request, $slug),
        ]);

        return redirect()->route('blog.listpost')->with('success', 'Post Berhasil Dibuat');
    }

    private function uploadImage(Request $request, string $slug)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
    
            $imageName = $originalName . '-' . time() . '.' . $extension;
            $image->storeAs('uploads', $imageName, 'public');
            
            return $imageName;
        }

        return null;
    }

    public function editBlogPost($idPost)
    {
        $authSam = Auth::user();
        $title = 'Edit Blog Post';
        $pages = 'blogpost';
        $post = BlogPost::find($idPost);
        $kategori = BlogKategori::all();

        return view('pages.admin.blog.editpost', compact('authSam', 'title', 'pages', 'post', 'kategori'));
    }

    public function updateBlogPost(Request $request, $idPost)
    {
        $authSam = Auth::user();

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'kategori_id' => 'nullable|exists:blog_kategori,id',
        ], [
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus salah satu dari: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 1MB.',
        ]);

        $blogPost = BlogPost::findOrFail($idPost);
        $slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($blogPost->image) {
                Storage::disk('public')->delete('uploads/' . $blogPost->image);
            }
            $imageName = $this->uploadImage($request, $slug);
        } else {
            $imageName = $blogPost->image;
        }

        $blogPost->update([
            'title' => $request->title,
            'slug' => $slug,
            'kategori_id' => $request->kategori_id ?? 1,
            'users_id' => $authSam->id,
            'content' => $request->content,
            'image' => $imageName,
        ]);

        return redirect()->route('blog.listpost')->with('success', 'Post Berhasil Diperbarui');
    }

    public function destroyBlogPost($id)
    {
        $post = BlogPost::findOrFail($id);

        DB::beginTransaction();

        try {
            $post->delete();
            DB::commit();
            return redirect()->route('blog.listpost')->with('success', 'Data post berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data post: ' . $e->getMessage());
        }
    }

    public function multidelBlogPost(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:blog_post,id',
        ]);

        $ids = $request->input('ids');

        DB::beginTransaction();
        try {
            BlogPost::whereIn('id', $ids)->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Post berhasil dihapus!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Post menghapus data ruang.'], 500);
        }
    }

    public function blogListKategori(Request $request)
    {
        $authSam = Auth::user();
        $cari = $request->get('cari');
        if ($cari) {
            $posts = BlogKategori::where('nama', 'like', '%' . $cari . '%')->get()
                ->paginate(config('app.pagination'));
        } else {
            $posts = BlogKategori::orderBy('nama', 'asc')->paginate(config('app.pagination'));
        }

        $title = 'Blog List';
        $pages = 'blogkategori';
        return view('pages.admin.blog.listkategori', compact('authSam', 'title', 'cari', 'pages', 'posts'));
    }

    public function blogCreateKategori()
    {
        $authSam = Auth::user();
        $title = 'Create Blog Kategori';
        $pages = 'blogkategori';
        return view('pages.admin.blog.createkategori', compact('authSam', 'title', 'pages'));
    }

    public function blogStoreKategori(Request $request)
    {
        $authSam = Auth::user();

        $request->validate([
            'nama' => 'required|max:255',
            'slug' => 'nullable|unique:blog_kategori,slug',
            'deskripsi' => 'nullable',
        ], [
            'slug.unique' => 'Slug sudah digunakan',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->nama);

        $blogPost = BlogKategori::create([
            'nama' => $request->nama,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('blog.listkategori')->with('success', 'Kategori Berhasil Dibuat');
    }

    public function editBlogKategori($idKategori)
    {
        $authSam = Auth::user();
        $title = 'Edit Blog Post';
        $pages = 'blogkategori';
        $kategori = BlogKategori::find($idKategori);

        return view('pages.admin.blog.editkategori', compact('authSam', 'title', 'pages', 'kategori'));
    }

    public function blogUpdateKategori(Request $request, $idKategori)
    {
        $authSam = Auth::user();

        $request->validate([
            'nama' => 'required|max:255',
            'slug' => 'nullable|unique:blog_kategori,slug,' . $idKategori,
            'deskripsi' => 'nullable',
        ], [
            'slug.unique' => 'Slug sudah digunakan',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->nama);

        $blogKategori = BlogKategori::findOrFail($idKategori);

        $blogKategori->update([
            'nama' => $request->nama,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('blog.listkategori')->with('success', 'Kategori Berhasil Diperbarui');
    }

    public function destroyBlogKategori($id)
    {
        $post = BlogKategori::findOrFail($id);

        DB::beginTransaction();

        try {
            $post->delete();
            DB::commit();
            return redirect()->route('blog.listkategori')->with('success', 'Data Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data kategori: ' . $e->getMessage());
        }
    }

    public function multidelBlogKategori(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:blog_kategori,id',
        ]);

        $ids = $request->input('ids');

        DB::beginTransaction();
        try {
            BlogKategori::whereIn('id', $ids)->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data kategori.'], 500);
        }
    }

    public function uploadSummernoteImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();

        $imageName = $originalName . '-' . time() . '.' . $extension;

        $image->storeAs('uploads', $imageName, 'public');

        return response()->json(['url' => asset('storage/uploads/' . $imageName)]);
    }

    return response()->json(['message' => 'Gambar gagal diunggah.'], 500);
}

}
