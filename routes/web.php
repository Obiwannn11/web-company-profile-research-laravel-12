<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RndController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PublicationController;


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

    Route::get('/', function () {
        return redirect()->route('locale.home', ['locale' => 'id']);
    });

    // 2. Grup untuk semua route yang memiliki prefix bahasa
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-z]{2}'],
    'middleware' => 'SetLocaleMiddleware',
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

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('services')->name('services.')->group(function() {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('', [ServiceController::class, 'store'])->name('store');
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/{service}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
        Route::get('/{service}', [ServiceController::class, 'show'])->name('show');
    });

    

});