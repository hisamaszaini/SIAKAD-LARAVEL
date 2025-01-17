<?php

use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminGuruController;
use App\Http\Controllers\AdminKelasController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\AdminRuangController;
use App\Http\Controllers\AdminMapelController;
use App\Http\Controllers\AdminJamPelajaranController;
use App\Http\Controllers\AdminJadwalController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminPengumumanController;
use App\Http\Controllers\AdminAbsensiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminTagihanController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AdminNilaiController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruNilaiController;
use App\Http\Controllers\GuruRapotController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckRole;

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'DONE';
  });

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//Blog
Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/lists', [BlogController::class, 'posts'])->name('blog.list');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.post');
Route::get('/blog/kategori/{slug}', [BlogController::class, 'kategoris'])->name('blog.kategori');

Route::group(['middleware' => ['auth:web', 'verified']], function () {
    //DASHBOARD-MENU
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
    Route::put('/profile/updatePassword', [UsersController::class, 'updatePassword'])->name('updatePassword');
    Route::put('/profile/updateEmail', [UsersController::class, 'updateEmail'])->name('updateEmail');
});

//Admin
Route::group(['middleware' => ['auth:web', 'verified', 'is_role:Admin']], function () {
    //Guru
    Route::get('/admin/guru', [AdminGuruController::class, 'index'])->name('guru.index');
    Route::get('/admin/guru/{id}', [AdminGuruController::class, 'edit'])->name('guru.edit');
    Route::put('/admin/guru/{id}', [AdminGuruController::class, 'update'])->name('guru.update');
    Route::delete('/admin/guru/{id}', [AdminGuruController::class, 'destroy'])->name('guru.destroy');
    Route::get('/admin/dataguru/cari', [AdminGuruController::class, 'cari'])->name('guru.cari');
    Route::get('/admin/dataguru/create', [AdminGuruController::class, 'create'])->name('guru.create');
    Route::post('/admin/dataguru', [AdminGuruController::class, 'store'])->name('guru.store');
    Route::delete('/admin/dataguru/multidel', [AdminGuruController::class, 'multidel'])->name('guru.multidel');

    //Kelas
    Route::get('/admin/kelas', [AdminKelasController::class, 'index'])->name('kelas.index');
    Route::get('/admin/kelas/{id}', [AdminKelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/admin/kelas/{id}', [AdminKelasController::class, 'update'])->name('kelas.update');
    Route::delete('/admin/kelas/{id}', [AdminKelasController::class, 'destroy'])->name('kelas.destroy');
    Route::get('/admin/datakelas/cari', [AdminKelasController::class, 'cari'])->name('kelas.cari');
    Route::get('/admin/datakelas/create', [AdminKelasController::class, 'create'])->name('kelas.create');
    Route::post('/admin/datakelas/kelas', [AdminKelasController::class, 'store'])->name('kelas.store');
    Route::delete('/admin/datakelas/multidel', [AdminKelasController::class, 'multidel'])->name('kelas.multidel');

    //Siswa
    Route::get('/admin/siswa', [AdminSiswaController::class, 'index'])->name('siswa.index');
    Route::get('/admin/siswa/{id}', [AdminSiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/admin/siswa/{id}', [AdminSiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/admin/siswa/{id}', [AdminSiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::get('/admin/datasiswa/cari', [AdminSiswaController::class, 'cari'])->name('siswa.cari');
    Route::get('/admin/datasiswa/create', [AdminSiswaController::class, 'create'])->name('siswa.create');
    Route::post('/admin/datasiswa', [AdminSiswaController::class, 'store'])->name('siswa.store');
    Route::delete('/admin/datasiswa/multidel', [AdminSiswaController::class, 'multidel'])->name('siswa.multidel');
    Route::get('/admin/export-siswa', [AdminSiswaController::class, 'export'])->name('siswa.export');;


    //Ruang
    Route::get('/admin/ruang', [AdminRuangController::class, 'index'])->name('ruang.index');
    Route::get('/admin/ruang/{id}', [AdminRuangController::class, 'edit'])->name('ruang.edit');
    Route::put('/admin/ruang/{id}', [AdminRuangController::class, 'update'])->name('ruang.update');
    Route::delete('/admin/ruang/{id}', [AdminRuangController::class, 'destroy'])->name('ruang.destroy');
    Route::get('/admin/dataruang/cari', [AdminRuangController::class, 'cari'])->name('ruang.cari');
    Route::get('/admin/dataruang/create', [AdminRuangController::class, 'create'])->name('ruang.create');
    Route::post('/admin/dataruang', [AdminRuangController::class, 'store'])->name('ruang.store');
    Route::delete('/admin/dataruang/multidel', [AdminRuangController::class, 'multidel'])->name('ruang.multidel');

    //Kategori
    Route::get('/admin/kategori', [AdminKategoriController::class, 'index'])->name('kategori.index');
    Route::get('/admin/kategori/{id}', [AdminKategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/admin/kategori/{id}', [AdminKategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/admin/kategori/{id}', [AdminKategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/admin/datakategori/cari', [AdminKategoriController::class, 'cari'])->name('kategori.cari');
    Route::get('/admin/datakategori/create', [AdminKategoriController::class, 'create'])->name('kategori.create');
    Route::post('/admin/datakategori', [AdminKategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/admin/datakategori/multidel', [AdminKategoriController::class, 'multidel'])->name('kategori.multidel');

    //Mapel
    Route::get('/admin/mapel', [AdminMapelController::class, 'index'])->name('mapel.index');
    Route::get('/admin/mapel/{id}', [AdminMapelController::class, 'edit'])->name('mapel.edit');
    Route::put('/admin/mapel/{id}', [AdminMapelController::class, 'update'])->name('mapel.update');
    Route::delete('/admin/mapel/{id}', [AdminMapelController::class, 'destroy'])->name('mapel.destroy');
    Route::get('/admin/datamapel/cari', [AdminMapelController::class, 'cari'])->name('mapel.cari');
    Route::get('/admin/datamapel/create', [AdminMapelController::class, 'create'])->name('mapel.create');
    Route::post('/admin/datamapel', [AdminMapelController::class, 'store'])->name('mapel.store');
    Route::delete('/admin/datamapel/multidel', [AdminMapelController::class, 'multidel'])->name('mapel.multidel');

    //JamPelajaran
    Route::get('/admin/jampelajaran', [AdminJamPelajaranController::class, 'index'])->name('jampelajaran.index');
    Route::get('/admin/jampelajaran/{id}', [AdminJamPelajaranController::class, 'edit'])->name('jampelajaran.edit');
    Route::put('/admin/jampelajaran/{id}', [AdminJamPelajaranController::class, 'update'])->name('jampelajaran.update');
    Route::delete('/admin/jampelajaran/{id}', [AdminJamPelajaranController::class, 'destroy'])->name('jampelajaran.destroy');
    Route::get('/admin/datajampelajaran/cari', [AdminJamPelajaranController::class, 'cari'])->name('jampelajaran.cari');
    Route::get('/admin/datajampelajaran/create', [AdminJamPelajaranController::class, 'create'])->name('jampelajaran.create');
    Route::post('/admin/datajampelajaran', [AdminJamPelajaranController::class, 'store'])->name('jampelajaran.store');
    Route::delete('/admin/datajampelajaran/multidel', [AdminJamPelajaranController::class, 'multidel'])->name('jampelajaran.multidel');

    //Jadwal
    Route::get('/admin/jadwal', [AdminJadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/admin/jadwal/{id}', [AdminJadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/admin/jadwal/{id}', [AdminJadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/admin/jadwal/{id}', [AdminJadwalController::class, 'destroy'])->name('jadwal.destroy');
    Route::get('/admin/datajadwal/cari', [AdminJadwalController::class, 'cari'])->name('jadwal.cari');
    Route::get('/admin/datajadwal/create', [AdminJadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/admin/datajadwal', [AdminJadwalController::class, 'store'])->name('jadwal.store');
    Route::delete('/admin/datajadwal/multidel', [AdminJadwalController::class, 'multidel'])->name('jadwal.multidel');

    //Pengumuman
    Route::get('/admin/pengumuman', [AdminPengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/admin/pengumuman/{id}', [AdminPengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::put('/admin/pengumuman/{id}', [AdminPengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/admin/pengumuman/{id}', [AdminPengumumanController::class, 'destroy'])->name('pengumuman.destroy');
    Route::get('/admin/datapengumuman/cari', [AdminPengumumanController::class, 'cari'])->name('pengumuman.cari');
    Route::get('/admin/datapengumuman/create', [AdminPengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('/admin/datapengumuman', [AdminPengumumanController::class, 'store'])->name('pengumuman.store');
    Route::delete('/admin/datapengumuman/multidel', [AdminPengumumanController::class, 'multidel'])->name('pengumuman.multidel');

    //Absensi
    Route::get('/admin/absensi', [AdminAbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/admin/absensi/{id}', [AdminAbsensiController::class, 'view'])->name('absensi.view');

    //Tagihan
    Route::get('/admin/tagihan', [AdminTagihanController::class, 'index'])->name('tagihan.index');
    Route::get('/admin/tagihan/{id}', [AdminTagihanController::class, 'edit'])->name('tagihan.edit');
    Route::put('/admin/tagihan/{id}', [AdminTagihanController::class, 'update'])->name('tagihan.update');
    Route::delete('/admin/tagihan/{id}', [AdminTagihanController::class, 'destroy'])->name('tagihan.destroy');
    Route::get('/admin/datatagihan', [AdminTagihanController::class, 'create'])->name('tagihan.create');
    Route::post('/admin/datatagihan', [AdminTagihanController::class, 'store'])->name('tagihan.store');
    Route::post('/admin/penagihan/{tagihanId}', [AdminTagihanController::class, 'createPenagihan'])->name('penagihan.create');
    Route::get('/admin/export-tagihan/{id}', [AdminTagihanController::class, 'export'])->name('tagihan.export');


    //Penagihan
    Route::get('/admin/daftarpenagihan/{tagihanId}', [AdminTagihanController::class, 'daftarPenagihan'])->name('penagihan.daftar');
    Route::post('/admin/penagihan/{id}/update-status', [AdminTagihanController::class, 'updateStatus'])->name('penagihan.updateStatus');

    //Nilai Siswa
    Route::get('/admin/nilai', [AdminNilaiController::class, 'index'])->name('nilai.index');
    Route::get('/admin/nilai/{jadwal_id}/{guru_id}', [AdminNilaiController::class, 'view'])->name('nilai.view');
    Route::get('/admin/nilaisiswa/{id}', [AdminNilaiController::class, 'viewnilaisiswa'])->name('nilai.siswa');

    //Blog Post
    Route::get('/admin/blog/posts', [AdminBlogController::class, 'blogListPost'])->name('blog.listpost');
    Route::get('/admin/blog/post/create', [AdminBlogController::class, 'blogCreatePost'])->name('blog.createpost');
    Route::post('/admin/blog/datapost', [AdminBlogController::class, 'blogStorePost'])->name('blog.storepost');
    Route::get('/admin/blog/datapost/{idPost}/edit', [AdminBlogController::class, 'editBlogPost'])->name('blog.editpost');
    Route::put('/admin/blog/datapost/{idPost}', [AdminBlogController::class, 'updateBlogPost'])->name('blog.updatepost');
    Route::delete('/admin/blog/datapost/{idPost}', [AdminBlogController::class, 'destroyBlogPost'])->name('blog.destroypost');
    Route::delete('/admin/blog/datapost/multidel', [AdminBlogController::class, 'multidelBlogPost'])->name('blog.multidelpost');
    Route::post('/admin/blog/upload-image', [AdminBlogController::class, 'uploadSummernoteImage'])->name('upload.summernote.image');
    
    //Blog Kategori
    Route::get('/admin/blog/kategori', [AdminBlogController::class, 'blogListKategori'])->name('blog.listkategori');
    Route::get('/admin/blog/kategori/create', [AdminBlogController::class, 'blogCreateKategori'])->name('blog.createkategori');
    Route::post('/admin/blog/datakategori', [AdminBlogController::class, 'blogStoreKategori'])->name('blog.storekategori');
    Route::get('/admin/blog/datakategori/{idKategori}/edit', [AdminBlogController::class, 'editBlogKategori'])->name('blog.editkategori');
    Route::put('/admin/blog/datakategori/{idKategori}', [AdminBlogController::class, 'blogUpdateKategori'])->name('blog.updatekategori');
    Route::delete('/admin/blog/datakategori/{idKategori}', [AdminBlogController::class, 'destroyBlogKategori'])->name('blog.destroykategori');
    Route::delete('/admin/blog/datakategori/multidel', [AdminBlogController::class, 'multidelBlogKategori'])->name('blog.multidelkategori');

    Route::get('/admin/settings', [AdminSettingController::class, 'index'])->name('settings');
    Route::put('/admin/datasettings', [AdminSettingController::class, 'store'])->name('settings.store');
    Route::get('/admin/chart-data', [DashboardController::class, 'chartData']);

});

//Guru
Route::group(['middleware' => ['auth:web', 'verified', 'is_role:Guru']], function () {
    Route::prefix('guru')->group(function () {
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('guru.absensi.index');
        Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('guru.absensi.create');
        Route::get('/absensi/cari', [AbsensiController::class, 'search'])->name('guru.absensi.cari');
        Route::post('/absensi', [AbsensiController::class, 'store'])->name('guru.absensi.store');
        Route::get('/absensi/{id}', [AbsensiController::class, 'edit'])->name('guru.absensi.edit');
        Route::put('/absensi/{id}', [AbsensiController::class, 'update'])->name('guru.absensi.update');
        Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('guru.absensi.destroy');
        Route::get('/absensi/{id}/kehadiran/isi', [AbsensiController::class, 'createKehadiran'])->name('guru.absensi.isikehadiran');
        Route::post('/kehadiran', [AbsensiController::class, 'storeKehadiran'])->name('guru.kehadiran.store');
        Route::get('/nilai', [GuruNilaiController::class, 'index'])->name('guru.nilai.index');
        Route::get('/nilai/{id_jadwal}', [GuruNilaiController::class, 'createDeskripsi'])->name('guru.nilai.create');
        Route::post('/nilai', [GuruNilaiController::class, 'storeDeskripsi'])->name('guru.nilai.storeDeskripsi');
        Route::get('/isi-nilai/{id_jadwal}', [GuruRapotController::class, 'createNilai'])->name('guru.nilairapot.create');
        Route::post('/isi-nilai/{id_jadwal}', [GuruRapotController::class, 'storeNilai'])->name('guru.nilairapot.store');
        Route::get('/biodata', [GuruController::class, 'biodata'])->name('guru.biodata');
        Route::get('/editbiodata', [GuruController::class, 'editBiodata'])->name('guru.editbio');
        Route::put('/updatebio', [GuruController::class, 'updateBiodata'])->name('guru.updatebio');
        Route::get('/jadwal', [GuruController::class, 'lihatJadwal'])->name('guru.jadwal');
    });
});


//Siswa
Route::group(['middleware' => ['auth:web', 'verified', 'is_role:Siswa']], function () {
    Route::prefix('siswa')->group(function () {
        Route::get('/biodata', [SiswaController::class, 'biodata'])->name('siswa.biodata');
        Route::get('/editbiodata', [SiswaController::class, 'editBiodata'])->name('siswa.editbio');
        Route::put('/updatebio', [SiswaController::class, 'updateBiodata'])->name('siswa.updatebio');
        Route::get('/jadwal', [SiswaController::class, 'lihatJadwal'])->name('siswa.jadwal');
        Route::get('/kehadiran', [SiswaController::class, 'lihatKehadiran'])->name('siswa.kehadiran');
        Route::get('/rapot', [SiswaController::class, 'lihatRapot'])->name('siswa.rapot');
        Route::get('/tagihan', [SiswaController::class, 'lihatTagihan'])->name('siswa.tagihan');
    });
});

Route::get('/siswa/kwitansi/{penagihanId}', [AdminTagihanController::class, 'kwitansiPenagihan'])->name('siswa.kwitansi');