<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\Api\ApiSectionController;

Route::get('sections', [ApiSectionController::class, 'index']);

use App\Http\Controllers\Api\ApiBerandaController;

Route::get('beranda', [ApiBerandaController::class, 'index']);

use App\Http\Controllers\Api\ApiDetailBeritaController;

Route::get('detail-berita', [ApiDetailBeritaController::class, 'index']);


use App\Http\Controllers\Api\ApiGaleriController;

Route::get('galeri', [ApiGaleriController::class, 'index']);


use App\Http\Controllers\Api\ApiKalenderAkademikController;

Route::get('kalender-akademik', [ApiKalenderAkademikController::class, 'index']);
Route::get('kalender-akademik/{id}/download', [ApiKalenderAkademikController::class, 'downloadGambar']);

use App\Http\Controllers\Api\ApiKegiatanSantriController;

Route::get('kegiatan-santri', [ApiKegiatanSantriController::class, 'index']);

use App\Http\Controllers\Api\ApiKontakController;

Route::get('kontak', [ApiKontakController::class, 'index']);

use App\Http\Controllers\Api\ApiListBeritaController;

Route::get('list-berita', [ApiListBeritaController::class, 'index']);

use App\Http\Controllers\Api\ApiMhtqDuaController;

Route::get('mhtq-dua', [ApiMhtqDuaController::class, 'index']);

use App\Http\Controllers\Api\ApiMhtqFasilitasController;

Route::get('mhtq-fasilitas', [ApiMhtqFasilitasController::class, 'index']);

use App\Http\Controllers\Api\ApiMhtqKeunggulanController;

Route::get('mhtq-keunggulan', [ApiMhtqKeunggulanController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramBahasaController;

Route::get('program-bahasa', [ApiProgramBahasaController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramKeamananController;

Route::get('program-keamanan', [ApiProgramKeamananController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramKesehatanController;

Route::get('program-kesehatan', [ApiProgramKesehatanController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramOlahragaController;

Route::get('program-olahraga', [ApiProgramOlahragaController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramPengasuhanController;

Route::get('program-pengasuhan', [ApiProgramPengasuhanController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramTahfidzController;

Route::get('program-tahfidz', [ApiProgramTahfidzController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramTalimController;

Route::get('program-talim', [ApiProgramTalimController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramUbudiyahController;

Route::get('program-ubudiyah', [ApiProgramUbudiyahController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramWirausahaController;

Route::get('program-wirausaha', [ApiProgramWirausahaController::class, 'index']);

use App\Http\Controllers\Api\ApiTentangMhtqPendiriController;

Route::get('tentang-mhtq-pendiri', [ApiTentangMhtqPendiriController::class, 'index']);

use App\Http\Controllers\Api\ApiTentangMhtqPimpinanController;

Route::get('tentang-mhtq-pimpinan', [ApiTentangMhtqPimpinanController::class, 'index']);

use App\Http\Controllers\Api\ApiTentangMhtqProfileController;

Route::get('tentang-mhtq-profile', [ApiTentangMhtqProfileController::class, 'index']);

Route::get('/testimoni', [ApiBerandaController::class, 'testimoni']);

Route::get('/jumlah-beranda', [ApiBerandaController::class, 'JumlahBeranda']);

Route::get('/pendaftaran-santri', [ApiBerandaController::class, 'PendaftaranSantriBaru']);