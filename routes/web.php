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
    Route::post('/copy/data',[App\Http\Controllers\AdminKota\CopyController::class,'copy'])->name('adminkota-copy-data');
    Route::get('adminkota/profil',[App\Http\Controllers\AdminKota\ProfilController::class,'index'])->name('adminkota-profil');
    Route::post('adminkota/ubah/password',[App\Http\Controllers\AdminKota\ProfilController::class,'ubah_password'])->name('adminkota-ubahpassword');

    // Rute yang memerlukan autentikasi dan peran admin
    Route::get('/',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'anggaran'])->name('adminkota-dashboard');
    Route::post('/put/session',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'putsession'])->name('adminkota-putsession');

    // data pensiun
    Route::get('/data-pegawai/pensiun',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'pensiun'])->name('adminkota-pensiun');

    // rekap tpp
    Route::get('/pegawai-bulanan/tppperson',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'tppperson'])->name('adminkota-tpp-pegawai');
    Route::get('/pegawai-bulanan/totaltpp',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'totaltpp'])->name('adminkota-tpp-total');
    Route::get('/penjabaran/tpp',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'penjabaran'])->name('adminkota-penjabaran');
    Route::get('/penjabaran/tpp/excel/{opd}',[App\Http\Controllers\AdminKota\PegawaibulananController::class,'penjabaran_excel'])->name('adminkota-penjabaran-excel');

    // data catatan
    Route::get('/adminkota/daftar-catatan',[App\Http\Controllers\AdminKota\CatatanController::class,'daftar'])->name('adminkota-daftar-catatan');
    Route::get('/adminkota/history-catatan',[App\Http\Controllers\AdminKota\CatatanController::class,'history'])->name('adminkota-history-catatan');
    // Route::post('/data-catatan',[App\Http\Controllers\AdminKota\CatatanController::class,'store'])->name('adminkota-catatan.store');
    Route::put('/adminkota/data-catatan/{catatan}/pegawai',[App\Http\Controllers\AdminKota\CatatanController::class,'updatepegawai'])->name('adminkota-catatan.update-pegawai');
    Route::put('/adminkota/data-catatan/{catatan}/catatan',[App\Http\Controllers\AdminKota\CatatanController::class,'updatecatatan'])->name('adminkota-catatan.update-catatan');
    // Route::delete('/data-catatan/{catatan}',[App\Http\Controllers\AdminKota\CatatanController::class,'destroy'])->name('adminkota-catatan.destroy');

    // data pegawai
    Route::get('/data-pegawai',[App\Http\Controllers\AdminKota\PegawaiController::class,'index'])->name('adminkota-pegawai');
    Route::post('/data-pegawai',[App\Http\Controllers\AdminKota\PegawaiController::class,'store'])->name('adminkota-pegawai.store');
    Route::put('/data-pegawai/{pegawai}',[App\Http\Controllers\AdminKota\PegawaiController::class,'update'])->name('adminkota-pegawai.update');
    Route::delete('/data-pegawai/{pegawai}/destroy',[App\Http\Controllers\AdminKota\PegawaiController::class,'destroy'])->name('adminkota-pegawai.destroy');

    // master opd
    Route::get('/master-opd',[App\Http\Controllers\AdminKota\OpdController::class,'index'])->name('adminkota-opd');
    Route::post('/master-opd',[App\Http\Controllers\AdminKota\OpdController::class,'store'])->name('adminkota-opd.store');
    Route::put('/master-opd/{opd}',[App\Http\Controllers\AdminKota\OpdController::class,'update'])->name('adminkota-opd.update');
    Route::delete('/master-opd/{opd}',[App\Http\Controllers\AdminKota\OpdController::class,'destroy'])->name('adminkota-opd.destroy');

    // master sub opd
    Route::get('/master-sub-opd',[App\Http\Controllers\AdminKota\SubopdController::class,'index'])->name('adminkota-sub-opd');
    Route::post('/master-sub-opd',[App\Http\Controllers\AdminKota\SubopdController::class,'store'])->name('adminkota-sub-opd.store');
    Route::put('/master-sub-opd/{opd}',[App\Http\Controllers\AdminKota\SubopdController::class,'update'])->name('adminkota-sub-opd.update');
    Route::delete('/master-sub-opd/{opd}',[App\Http\Controllers\AdminKota\SubopdController::class,'destroy'])->name('adminkota-sub-opd.destroy');

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
    Route::get('/master-tahun',[App\Http\Controllers\AdminKota\TahunController::class,'index'])->name('adminkota-tahun');
    Route::post('/master-tahun',[App\Http\Controllers\AdminKota\TahunController::class,'store'])->name('adminkota-tahun.store');
    Route::get('master-tahun/edit/{id}',[App\Http\Controllers\AdminKota\TahunController::class,'edit'])->name('adminkota-tahun.edit');
    Route::post('/master-tahun/{id}',[App\Http\Controllers\AdminKota\TahunController::class,'update'])->name('adminkota-tahun.update');

    // Master Jabatan Lama
    // Route::get('/master-jabatanlama',[App\Http\Controllers\AdminKota\MasterjabatanlamaController::class,'index'])->name('adminkota-jabatanlama');
    // Route::get('/master-jabatanlama/edit/{kode_jabatanlama}',[App\Http\Controllers\AdminKota\MasterjabatanlamaController::class,'edit'])->name('adminkota-jabatanlama-edit');
    // Route::put('/master-jabatanlama/update/{kode_jabatanlama}',[App\Http\Controllers\AdminKota\MasterjabatanlamaController::class,'update'])->name('adminkota-jabatanlama-update');

    // Master Jabatan Baru
    // Route::get('/master-jabatanbaru',[App\Http\Controllers\AdminKota\MasterjabatanbaruController::class,'index'])->name('adminkota-jabatanbaru');
    // Route::get('/master-jabatanbaru/edit/{kode_jabatanbaru}',[App\Http\Controllers\AdminKota\MasterjabatanbaruController::class,'edit'])->name('adminkota-jabatanbaru-edit');
    // Route::put('/master-jabatanbaru/update/{kode_jabatanbaru}',[App\Http\Controllers\AdminKota\MasterjabatanbaruController::class,'update'])->name('adminkota-jabatanbaru-update');

});

Route::group(['middleware' => ['auth', 'adminopd']], function () {
    // Rute yang memerlukan autentikasi dan peran admin
    Route::post('adminopd/lock/data',[App\Http\Controllers\Adminopd\PegawaibulananOpdController::class,'lock'])->name('adminopd-lockdata');
    Route::get('adminopd/profil',[App\Http\Controllers\Adminopd\ProfilController::class,'index'])->name('adminopd-profil');
    Route::post('adminopd/ubah/password',[App\Http\Controllers\Adminopd\ProfilController::class,'ubah_password'])->name('adminopd-ubahpassword');

    // data pegawai
    Route::get('/admin-opd/data-pegawai',[App\Http\Controllers\Adminopd\PegawaibulananOpdController::class,'index'])->name('adminopd-pegawai');
    Route::post('/admin-opd/data-pegawai',[App\Http\Controllers\Adminopd\PegawaibulananOpdController::class,'store'])->name('adminopd-pegawai.store');
    Route::put('/admin-opd/data-pegawai/{pegawai}',[App\Http\Controllers\Adminopd\PegawaibulananOpdController::class,'update'])->name('adminopd-pegawai.update');
    Route::delete('/admin-opd/data-pegawai/{pegawai}',[App\Http\Controllers\Adminopd\PegawaibulananOpdController::class,'destroy'])->name('adminopd-pegawai.destroy');
    // pegawai catatan
    Route::get('/adminopd/data-catatan',[App\Http\Controllers\Adminopd\CatatanController::class,'index'])->name('adminopd-catatan');
    Route::post('/adminopd/data-catatan/store',[App\Http\Controllers\Adminopd\CatatanController::class,'store'])->name('adminopd-catatan.store');
    Route::put('/adminopd/data-catatan/{catatan}/update',[App\Http\Controllers\Adminopd\CatatanController::class,'update'])->name('adminopd-catatan.update');
    Route::get('/adminopd/data-catatan/{catatan}/destroy',[App\Http\Controllers\Adminopd\CatatanController::class,'destroy'])->name('adminopd-catatan.destroy');

    // // pegawai bulanan
    // Route::get('/admin-opd/pegawai-bulanan/tpp',[App\Http\Controllers\Adminopd\PegawaibulananOpdController::class,'tpp'])->name('adminopd-tpp-pegawai');
    Route::post('/admin-opd/put/session',[App\Http\Controllers\Adminopd\PegawaibulananOpdController::class,'putsession'])->name('adminopd-putsession');

});

Route::group(['middleware' => ['auth', 'adminjabatan']],function () {
    Route::get('adminjabatan/profil',[App\Http\Controllers\Adminjabatan\ProfilController::class,'index'])->name('adminjabatan-profil');
    Route::post('adminjabatan/ubah/password',[App\Http\Controllers\Adminjabatan\ProfilController::class,'ubah_password'])->name('adminjabatan-ubahpassword');

    Route::post('/admin-jabatan/put/session',[App\Http\Controllers\Adminjabatan\MasterjabatanlamaController::class,'putsession'])->name('adminjabatan-putsession');
    Route::get('/admin-jabatan/dashboard',[App\Http\Controllers\Adminjabatan\JabatanController::class,'dashboard'])->name('adminjabatan-dashboard');

    // master indeks
    Route::get('/admin-jabatan/master-indeks',[App\Http\Controllers\Adminjabatan\IndeksController::class,'index'])->name('adminjabatan-indeks');
    Route::post('/admin-jabatan/master-indeks',[App\Http\Controllers\Adminjabatan\IndeksController::class,'store'])->name('adminjabatan-indeks.store');
    Route::put('/admin-jabatan/master-indeks/{indeks}',[App\Http\Controllers\Adminjabatan\IndeksController::class,'update'])->name('adminjabatan-indeks.update');
    Route::delete('/admin-jabatan/master-indeks/{indeks}',[App\Http\Controllers\Adminjabatan\IndeksController::class,'destroy'])->name('adminjabatan-indeks.destroy');

    // master jabatan
    Route::get('/admin-jabatan/master-jabatan',[App\Http\Controllers\Adminjabatan\JabatanController::class,'index'])->name('adminjabatan-jabatan');
    Route::get('/admin-jabatan/undone-jabatan',[App\Http\Controllers\Adminjabatan\JabatanController::class,'undone'])->name('adminjabatan-jabatan.undone');
    Route::post('/admin-jabatan/master-jabatan/create',[App\Http\Controllers\Adminjabatan\JabatanController::class,'store'])->name('adminjabatan-jabatan.store');
    Route::put('/admin-jabatan/master-jabatan/{jabatan}/update',[App\Http\Controllers\Adminjabatan\JabatanController::class,'update'])->name('adminjabatan-jabatan.update');
    Route::delete('/admin-jabatan/master-jabatan/{jabatan}/delete',[App\Http\Controllers\Adminjabatan\JabatanController::class,'destroy'])->name('adminjabatan-jabatan.destroy');

    // Master Jabatan Lama
    Route::get('/admin-jabatan/master-jabatanlama',[App\Http\Controllers\Adminjabatan\MasterjabatanlamaController::class,'index'])->name('adminjabatan-jabatanlama');
    Route::get('/admin-jabatan/master-jabatanlama/edit/{kode_jabatanlama}',[App\Http\Controllers\Adminjabatan\MasterjabatanlamaController::class,'edit'])->name('adminjabatan-jabatanlama-edit');
    Route::put('/admin-jabatan/master-jabatanlama/update/{kode_jabatanlama}',[App\Http\Controllers\Adminjabatan\MasterjabatanlamaController::class,'update'])->name('adminjabatan-jabatanlama-update');

    // Master Jabatan Baru
    Route::get('/admin-jabatan/master-jabatanbaru',[App\Http\Controllers\Adminjabatan\MasterjabatanbaruController::class,'index'])->name('adminjabatan-jabatanbaru');
    Route::get('/admin-jabatan/master-jabatanbaru/edit/{kode_jabatanbaru}',[App\Http\Controllers\Adminjabatan\MasterjabatanbaruController::class,'edit'])->name('adminjabatan-jabatanbaru-edit');
    Route::put('/admin-jabatan/master-jabatanbaru/update/{kode_jabatanbaru}',[App\Http\Controllers\Adminjabatan\MasterjabatanbaruController::class,'update'])->name('adminjabatan-jabatanbaru-update');
});
