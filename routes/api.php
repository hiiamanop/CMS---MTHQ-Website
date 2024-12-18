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

use App\Http\Controllers\Api\ApiBerandaController;

Route::get('beranda', [ApiBerandaController::class, 'index']);

use App\Http\Controllers\Api\ApiDetailBeritaController;

Route::apiResource('detail-berita', [ApiDetailBeritaController::class, 'index']);


use App\Http\Controllers\Api\ApiGaleriController;

Route::apiResource('galeri', [ApiGaleriController::class, 'index']);

use App\Http\Controllers\Api\ApiKalenderAkademikController;

Route::apiResource('kalender-akademik', [ApiKalenderAkademikController::class, 'index']);

use App\Http\Controllers\Api\ApiKegiatanSantriController;

Route::apiResource('kegiatan-santri', [ApiKegiatanSantriController::class, 'index']);

use App\Http\Controllers\Api\ApiKontakController;

Route::apiResource('kontak', [ApiKontakController::class, 'index']);

use App\Http\Controllers\Api\ApiListBeritaController;

Route::apiResource('list-berita', [ApiListBeritaController::class, 'index']);

use App\Http\Controllers\Api\ApiMhtqDuaController;

Route::apiResource('mhtq-dua', [ApiMhtqDuaController::class, 'index']);

use App\Http\Controllers\Api\ApiMhtqFasilitasController;

Route::apiResource('mhtq-fasilitas', [ApiMhtqFasilitasController::class, 'index']);

use App\Http\Controllers\Api\ApiMhtqKeunggulanController;

Route::apiResource('mhtq-keunggulan', [ApiMhtqKeunggulanController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramBahasaController;

Route::apiResource('program-bahasa', [ApiProgramBahasaController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramKeamananController;

Route::apiResource('program-keamanan', [ApiProgramKeamananController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramKesehatanController;

Route::apiResource('program-kesehatan', [ApiProgramKesehatanController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramOlahragaController;

Route::apiResource('program-olahraga', [ApiProgramOlahragaController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramPengasuhanController;

Route::apiResource('program-pengasuhan', [ApiProgramPengasuhanController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramTahfidzController;

Route::apiResource('program-tahfidz', [ApiProgramTahfidzController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramTalimController;

Route::apiResource('program-talim', [ApiProgramTalimController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramUbudiyahController;

Route::apiResource('program-ubudiyah', [ApiProgramUbudiyahController::class, 'index']);

use App\Http\Controllers\Api\ApiProgramWirausahaController;

Route::apiResource('program-wirausaha', [ApiProgramWirausahaController::class, 'index']);

use App\Http\Controllers\Api\ApiTentangMhtqPendiriController;

Route::apiResource('tentang-mhtq-pendiri', [ApiTentangMhtqPendiriController::class, 'index']);

use App\Http\Controllers\Api\ApiTentangMhtqPimpinanController;

Route::apiResource('tentang-mhtq-pimpinan', [ApiTentangMhtqPimpinanController::class, 'index']);

use App\Http\Controllers\Api\ApiTentangMhtqProfileController;

Route::apiResource('tentang-mhtq-profile', [ApiTentangMhtqProfileController::class, 'index']);
