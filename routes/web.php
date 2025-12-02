<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostingController;

Route::get('/', [HomeController::class, 'homepage']);

// Keep /home pointing to the same homepage to avoid stale static text.
Route::redirect('/home', '/');

// Auth routes
Route::get('/login', function () {
	return view('auth.login');
})->name('login');

Route::get('/register', function () {
	return view('auth.register');
})->name('register');

Route::resource('/job-postings', JobPostingController::class);
Route::resource('/job-applications', JobApplicationController::class);

// Admin routes: protected by auth and admin middleware
	Route::prefix('/admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
		Route::resource('/companies', CompanyController::class);
		Route::resource('/job-postings', JobPostingController::class);
		Route::resource('/job-applications', JobApplicationController::class);
		Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');	// Route::resource(controller: JobApplicationController::class, name: '/job-applications');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware(['auth', 'admin']);

Route::prefix('/auth')->name('auth.')->controller(AuthController::class)->middleware('guest')->group(
	function () {
		Route::get('login', 'loginPage')->name('login.page');
		Route::get('register', 'registrationPage')->name('register.page');
		Route::post('register', 'register')->name('register');
		Route::post('login', 'login')->name('login');
		Route::post('logout', 'logout')->name('logout')->withoutMiddleware('guest');
	}
);
