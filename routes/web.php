<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use Illuminate\Support\Facades\Route;

// Fallback for the PHPFlasher core asset when the web server cannot read the
// generated public copy (the package installer still publishes the other assets).
Route::get('/vendor/flasher/flasher.min.js', static function () {
    return response()->file(
        base_path('vendor/php-flasher/flasher/Resources/public/flasher.min.js'),
        ['Content-Type' => 'application/javascript']
    );
});

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/blog', function () {
    return view('frontend.blog');
});

Route::get('/blog-details', function () {
    return view('frontend.blog-details');
});

Route::get('/portfolio-details', function () {
    return view('frontend.portfolio-details');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth', ], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('hero', HeroController::class);
});
