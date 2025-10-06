<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RndController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PublicationController;

Route::get('/', function () {
    return redirect()->route('locale.home', ['locale' => 'id']);
});

// 2. Grup untuk semua route yang memiliki prefix bahasa
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-z]{2}'],
    'as' => 'locale.', // 'as' adalah alias untuk 'name' dalam grup
    ], function() {

    // Route untuk Home
    Route::get('/', [PageController::class, 'home'])->name('home');

    // Routes untuk Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

    // Routes untuk R&D
    Route::prefix('rnd')->name('rnd.')->group(function() {
        Route::get('/projects', [RndController::class, 'projects'])->name('projects');
        Route::get('/research', [RndController::class, 'research'])->name('research');
        Route::get('/publication', [RndController::class, 'publication'])->name('publication');
    });

    // Route untuk Tools
    Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');

    // Routes untuk About Us
    Route::prefix('about')->name('about.')->group(function() {
        Route::get('/company', [AboutController::class, 'company'])->name('company');
        Route::get('/team', [AboutController::class, 'team'])->name('team');
        Route::get('/faq', [AboutController::class, 'faq'])->name('faq');
    });

    // Route untuk Contact
    Route::get('/contact', [AboutController::class, 'index'])->name('contact.index');

});