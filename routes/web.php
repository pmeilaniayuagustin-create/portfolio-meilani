<?php

use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Models\Education;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;

// ===== Halaman publik =====
Route::get('/', [HomeController::class, 'index'])->name('home');

// ===== Login admin =====
Route::get('/masuk', [LoginController::class, 'showLogin'])->name('login');
Route::post('/masuk', [LoginController::class, 'login'])->name('login.proses');
Route::post('/keluar', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ===== Halaman admin (harus login) =====
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard', [
            'jumlah' => [
                'kemampuan'  => Skill::count(),
                'pendidikan' => Education::count(),
                'organisasi' => Organization::count(),
                'karya'      => Project::count(),
            ],
        ]);
    })->name('dashboard');

    Route::get('pengaturan', [SettingController::class, 'edit'])->name('pengaturan.edit');
    Route::put('pengaturan', [SettingController::class, 'update'])->name('pengaturan.update');

    Route::resource('kemampuan', SkillController::class)->parameters(['kemampuan' => 'skill'])->except('show');
    Route::resource('pendidikan', EducationController::class)->parameters(['pendidikan' => 'education'])->except('show');
    Route::patch('organisasi/{organization}/foto', [OrganizationController::class, 'foto'])->name('organisasi.foto');
    Route::patch('karya/{project}/foto', [ProjectController::class, 'foto'])->name('karya.foto');

    Route::resource('organisasi', OrganizationController::class)->parameters(['organisasi' => 'organization'])->except('show');
    Route::resource('karya', ProjectController::class)->parameters(['karya' => 'project'])->except('show');
});
