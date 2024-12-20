<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



use App\Http\Controllers\Auth\AuthController;

// Rute untuk menampilkan form login (GET)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');



// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Registration Routes (optional)
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'role.check'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

use App\Http\Controllers\AdministratorController;

Route::resource('administrators', AdministratorController::class);

use App\Http\Controllers\WargaController;

Route::resource('warga', WargaController::class);

use App\Http\Controllers\RoleController;

Route::resource('roles', RoleController::class);
Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

use App\Http\Controllers\SectionController;

Route::resource('sections', SectionController::class);

use App\Http\Controllers\BerandaController;

Route::resource('berandas', BerandaController::class);

use App\Http\Controllers\KegiatanSantriController;

Route::resource('kegiatan_santris', KegiatanSantriController::class);

use App\Http\Controllers\MhtqDuaController;

Route::resource('mhtq_duas', MhtqDuaController::class);

use App\Http\Controllers\KontakController;

Route::resource('kontaks', KontakController::class);

use App\Http\Controllers\ProgramBahasaController;

Route::resource('program_bahasas', ProgramBahasaController::class);

use App\Http\Controllers\ProgramKeamananController;

Route::resource('program_keamanan', ProgramKeamananController::class);

use App\Http\Controllers\ProgramKesehatanController;

Route::resource('program_kesehatan', ProgramKesehatanController::class);

use App\Http\Controllers\ProgramOlahragaController;

Route::resource('program_olahraga', ProgramOlahragaController::class);

use App\Http\Controllers\ProgramPengasuhanController;

Route::resource('program_pengasuhan', ProgramPengasuhanController::class);

use App\Http\Controllers\ProgramTahfidzController;

Route::resource('program_tahfidz', ProgramTahfidzController::class);

use App\Http\Controllers\ProgramTalimController;

Route::resource('program_talim', ProgramTalimController::class);

use App\Http\Controllers\ProgramUbudiyahController;

Route::resource('program_ubudiyah', ProgramUbudiyahController::class);

use App\Http\Controllers\ProgramWirausahaController;

Route::resource('program_wirausaha', ProgramWirausahaController::class);

use App\Http\Controllers\GaleriController;

Route::resource('galeris', GaleriController::class);

use App\Http\Controllers\ListBeritaController;

Route::resource('list_beritas', ListBeritaController::class);

use App\Http\Controllers\DetailBeritaController;

Route::resource('detail-beritas', DetailBeritaController::class);

use App\Http\Controllers\TentangMhtqPendiriController;

Route::resource('tentang_mhtq_pendiri', TentangMhtqPendiriController::class);

use App\Http\Controllers\TentangMhtqPimpinanController;

Route::resource('tentang_mhtq_pimpinan', TentangMhtqPimpinanController::class);

use App\Http\Controllers\TentangMhtqProfileController;

Route::resource('tentang_mhtq_profiles', TentangMhtqProfileController::class);

use App\Http\Controllers\MhtqFasilitasController;

Route::resource('mhtq_fasilitass', MhtqFasilitasController::class);

use App\Http\Controllers\MhtqKeunggulanController;

Route::resource('mhtq_keunggulans', MhtqKeunggulanController::class);

use App\Http\Controllers\KalenderAkademikController;

Route::resource('kalender_akademiks', KalenderAkademikController::class);












