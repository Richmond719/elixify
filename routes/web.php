<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\StudentController;

Route::get('/', [HomeController::class, 'homepage']);

// Keep /home pointing to the same homepage to avoid stale static text.
Route::redirect('/home', '/');

Route::resource('/job-postings', JobPostingController::class);
Route::resource('/job-applications', JobApplicationController::class);

// Group admin routes so they use the `admin.` name prefix and `/admin` URL prefix
Route::prefix('admin')->name('admin.')->group(function () {
	Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
	Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
	Route::resource('companies', CompanyController::class);
	Route::resource('job_postings', JobPostingController::class);
});
