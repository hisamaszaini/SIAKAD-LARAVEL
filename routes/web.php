<?php

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
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::group(['middleware' => ['auth:web', 'verified']], function () {

    //DASHBOARD-MENU
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
    Route::put('/profile/updatePassword', [UsersController::class, 'updatePassword'])->name('updatePassword');
    Route::put('/profile/updateEmail', [UsersController::class, 'updateEmail'])->name('updateEmail');

    //MASTERING
    // Route::get('/admin/users', [UsersController::class, 'index'])->name('users');
    // Route::get('/admin/users/{id}', [UsersController::class, 'edit'])->name('users.edit');
    // Route::put('/admin/users/{id}', [UsersController::class, 'update'])->name('users.update');
    // Route::delete('/admin/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    // Route::get('/admin/datausers/cari', [UsersController::class, 'cari'])->name('users.cari');
    // Route::get('/admin/datausers/create', [UsersController::class, 'create'])->name('users.create');
    // Route::post('/admin/datausers', [UsersController::class, 'store'])->name('users.store');
    // Route::delete('/admin/datausers/multidel', [UsersController::class, 'multidel'])->name('users.multidel');

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

    //Membuat Absensi (Guru)
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
    });

    //Siswa
    Route::prefix('siswa')->group(function () {
        Route::get('/biodata', [SiswaController::class, 'biodata'])->name('siswa.biodata');
        Route::get('/jadwal', [SiswaController::class, 'lihatJadwal'])->name('siswa.jadwal');
        Route::get('/editbiodata', [SiswaController::class, 'editBiodata'])->name('siswa.editbio');
        Route::put('/updatebio', [SiswaController::class, 'updateBiodata'])->name('siswa.updatebio');
    });
});
