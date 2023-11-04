<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['guest'])->group(function () {
    // login
Route::get('/login', [App\Http\Controllers\AuthController::class,'loginForm'])->name('loginform');
Route::post('/login', [App\Http\Controllers\AuthController::class,'login'])->name('login');
});

Route::get('/logout',[App\Http\Controllers\AuthController::class,'logout'])->name('logout')->middleware('auth');

Route::group(['middleware' => ['auth', 'adminkota']], function () {
    // Rute yang memerlukan autentikasi dan peran admin
    Route::get('/',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'anggaran'])->name('adminkota-dashboard');
    Route::post('/put/session',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'putsession'])->name('adminkota-putsession');

    // pegawai bulanan
    Route::get('/pegawai-bulanan/tpp',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'tpp'])->name('adminkota-tpp-pegawai');
    Route::get('/pegawai-bulanan/totaltpp',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'totaltpp'])->name('adminkota-tpp-total');

    // master opd
    Route::get('/master-opd',[App\Http\Controllers\AdminKota\OpdController::class,'index'])->name('adminkota-opd');
    Route::post('/master-opd',[App\Http\Controllers\AdminKota\OpdController::class,'store'])->name('adminkota-opd.store');
    Route::put('/master-opd/{opd}',[App\Http\Controllers\AdminKota\OpdController::class,'update'])->name('adminkota-opd.update');
    Route::delete('/master-opd/{opd}',[App\Http\Controllers\AdminKota\OpdController::class,'destroy'])->name('adminkota-opd.destroy');

    // master indeks
    Route::get('/master-indeks',[App\Http\Controllers\AdminKota\IndeksController::class,'index'])->name('adminkota-indeks');
    Route::post('/master-indeks',[App\Http\Controllers\AdminKota\IndeksController::class,'store'])->name('adminkota-indeks.store');
    Route::put('/master-indeks/{indeks}',[App\Http\Controllers\AdminKota\IndeksController::class,'update'])->name('adminkota-indeks.update');
    Route::delete('/master-indeks/{indeks}',[App\Http\Controllers\AdminKota\IndeksController::class,'destroy'])->name('adminkota-indeks.destroy');

    // master jabatan
    Route::get('/master-jabatan',[App\Http\Controllers\AdminKota\JabatanController::class,'index'])->name('adminkota-jabatan');
    Route::post('/master-jabatan',[App\Http\Controllers\AdminKota\JabatanController::class,'store'])->name('adminkota-jabatan.store');
    Route::put('/master-jabatan/{jabatan}',[App\Http\Controllers\AdminKota\JabatanController::class,'update'])->name('adminkota-jabatan.update');
    Route::delete('/master-jabatan/{jabatan}',[App\Http\Controllers\AdminKota\JabatanController::class,'destroy'])->name('adminkota-jabatan.destroy');

    // master rupiah
    Route::get('/master-rupiah',[App\Http\Controllers\AdminKota\RupiahController::class,'index'])->name('adminkota-rupiah');
    Route::post('/master-rupiah',[App\Http\Controllers\AdminKota\RupiahController::class,'store'])->name('adminkota-rupiah.store');
    Route::get('master-rupiah/edit/{id}',[App\Http\Controllers\AdminKota\RupiahController::class,'edit'])->name('adminkota-rupiah.edit');
    Route::post('/master-rupiah/{id}',[App\Http\Controllers\AdminKota\RupiahController::class,'update'])->name('adminkota-rupiah.update');
    Route::delete('/master-rupiah/{id}',[App\Http\Controllers\AdminKota\RupiahController::class,'destroy'])->name('adminkota-rupiah.destroy');

    // master tahun
    Route::get('/master-tahun',[App\Http\Controllers\Adminkota\TahunController::class,'index'])->name('adminkota-tahun');
    Route::post('/master-tahun',[App\Http\Controllers\Adminkota\TahunController::class,'store'])->name('adminkota-tahun.store');
    Route::get('master-tahun/edit/{id}',[App\Http\Controllers\Adminkota\TahunController::class,'edit'])->name('adminkota-tahun.edit');
    Route::post('/master-tahun/{id}',[App\Http\Controllers\Adminkota\TahunController::class,'update'])->name('adminkota-tahun.update');

    // Master Jabatan Lama
    Route::get('/master-jabatanlama',[App\Http\Controllers\Adminkota\MasterjabatanlamaController::class,'index'])->name('adminkota-jabatanlama');
    Route::get('/master-jabatanlama/edit/{kode_jabatanlama}',[App\Http\Controllers\Adminkota\MasterjabatanlamaController::class,'edit'])->name('adminkota-jabatanlama-edit');
    Route::put('/master-jabatanlama/update/{kode_jabatanlama}',[App\Http\Controllers\Adminkota\MasterjabatanlamaController::class,'update'])->name('adminkota-jabatanlama-update');

    // Master Jabatan Baru
    Route::get('/master-jabatanbaru',[App\Http\Controllers\Adminkota\MasterjabatanbaruController::class,'index'])->name('adminkota-jabatanbaru');
    Route::get('/master-jabatanbaru/edit/{kode_jabatanbaru}',[App\Http\Controllers\Adminkota\MasterjabatanbaruController::class,'edit'])->name('adminkota-jabatanbaru-edit');
    Route::put('/master-jabatanbaru/update/{kode_jabatanbaru}',[App\Http\Controllers\Adminkota\MasterjabatanbaruController::class,'update'])->name('adminkota-jabatanbaru-update');

});

Route::group(['middleware' => ['auth', 'adminopd']], function () {
    // Rute yang memerlukan autentikasi dan peran admin

    // pegawai bulanan
    Route::get('/admin-opd/pegawai-bulanan/tpp',[App\Http\Controllers\Adminopd\PegawaibulananOpdController::class,'tpp'])->name('adminopd-tpp-pegawai');
    Route::post('/admin-opd/put/session',[App\Http\Controllers\Adminopd\PegawaibulananOpdController::class,'putsession'])->name('adminopd-putsession');

});

Route::group(['middleware' => ['auth', 'adminjabatan']],function () {
    Route::post('/admin-jabatan/put/session',[App\Http\Controllers\Adminjabatan\MasterjabatanlamaController::class,'putsession'])->name('adminjabatan-putsession');

    // Master Jabatan Lama
    Route::get('/admin-jabatan/master-jabatanlama',[App\Http\Controllers\Adminjabatan\MasterjabatanlamaController::class,'index'])->name('adminjabatan-jabatanlama');
    Route::get('/admin-jabatan/master-jabatanlama/edit/{kode_jabatanlama}',[App\Http\Controllers\Adminjabatan\MasterjabatanlamaController::class,'edit'])->name('adminjabatan-jabatanlama-edit');
    Route::put('/admin-jabatan/master-jabatanlama/update/{kode_jabatanlama}',[App\Http\Controllers\Adminjabatan\MasterjabatanlamaController::class,'update'])->name('adminjabatan-jabatanlama-update');

    // Master Jabatan Baru
    Route::get('/admin-jabatan/master-jabatanbaru',[App\Http\Controllers\Adminjabatan\MasterjabatanbaruController::class,'index'])->name('adminjabatan-jabatanbaru');
    Route::get('/admin-jabatan/master-jabatanbaru/edit/{kode_jabatanbaru}',[App\Http\Controllers\Adminjabatan\MasterjabatanbaruController::class,'edit'])->name('adminjabatan-jabatanbaru-edit');
    Route::put('/admin-jabatan/master-jabatanbaru/update/{kode_jabatanbaru}',[App\Http\Controllers\Adminjabatan\MasterjabatanbaruController::class,'update'])->name('adminjabatan-jabatanbaru-update');
});
