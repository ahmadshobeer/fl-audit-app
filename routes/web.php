<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\StrukturOrganisasiController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers;

Route::get('/test-db', function () {
    try {
        $data = DB::connection()->getPdo();
        return "Koneksi berhasil: " . $data->getAttribute(PDO::ATTR_DRIVER_NAME);
    } catch (\Exception $e) {
        return "Koneksi gagal: " . $e->getMessage();
    }
});

Route::get('/', function () {
    return view('dashboard');
});

/* Route::get('/struktur-organisasi', function () {
    return view('struktur-organisasi');
}); */

Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index']);
Route::get('/sop', function () {
    return view('standard-operating-procedure');
});

Route::get('/api/companies', [ApiController::class, 'getCompanies']);
