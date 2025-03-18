<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\StrukturOrganisasiController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('menu.dashboard');
    });
    
    
    
    Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index']);
    Route::get('/sop', function () {
        return view('menu.standard-operating-procedure');
    });
    
    
    Route::get('/login', [AuthController::class, 'index'])->name('login');

    //USER
    Route::resource('/users',UserController::class);
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    //API
    Route::get('/api/divisions', [ApiController::class, 'getDivisions']);
    Route::get('/api/division-head/{divisi_id}', [ApiController::class, 'getHeadOfDivision']); //belum bisa
    Route::get('/api/companies', [ApiController::class, 'getCompanies']);
    Route::get('/api/regions', [ApiController::class, 'getRegions']);
    Route::get('/api/positions', [ApiController::class, 'getPositions']);
    Route::get('/api/branches-regional/{regional_id}', [ApiController::class, 'getBranchByRegion']);
    Route::get('/api/branch-head/{branch_id}/', [ApiController::class, 'getHeadBranch']);
    Route::get('/api/company-head/{company_id}', [ApiController::class, 'getHeadCompany']);

});

//AUTH
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

