<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RndController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\PublicationCategoryController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\ToolController as AdminToolController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\PublicationController as AdminPublicationController;
use App\Http\Controllers\Admin\PublicationCategoryController as AdminPublicationCategoryController;



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('services')->name('services.')->group(function() {
        Route::get('/', [AdminServiceController::class, 'index'])->name('index');
        Route::get('/create', [AdminServiceController::class, 'create'])->name('create');
        Route::post('', [AdminServiceController::class, 'store'])->name('store');
        Route::get('/{service}/edit', [AdminServiceController::class, 'edit'])->name('edit');
        Route::put('/{service}', [AdminServiceController::class, 'update'])->name('update');
        Route::delete('/{service}', [AdminServiceController::class, 'destroy'])->name('destroy');
        Route::get('/{service}', [AdminServiceController::class, 'show'])->name('show');
    });

    Route::controller(AdminTeamController::class)->prefix('team')->name('team.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{team}/edit', 'edit')->name('edit');
        Route::put('/{team}', 'update')->name('update');
        Route::delete('/{team}', 'destroy')->name('destroy');
    });

    Route::controller(AdminFaqController::class)->prefix('faq')->name('faq.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{faq}/edit', 'edit')->name('edit');
        Route::put('/{faq}', 'update')->name('update');
        Route::delete('/{faq}', 'destroy')->name('destroy');
    });


    Route::controller(AdminToolController::class)->prefix('tools')->name('tools.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{tool}/edit', 'edit')->name('edit');
        Route::put('/{tool}', 'update')->name('update');
        Route::delete('/{tool}', 'destroy')->name('destroy');
    });

    Route::controller(AdminProjectController::class)->prefix('projects')->name('projects.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{project}/edit', 'edit')->name('edit');
        Route::put('/{project}', 'update')->name('update');
        Route::delete('/{project}', 'destroy')->name('destroy');
    });

    Route::controller(AdminPublicationCategoryController::class)->prefix('publication-categories')->name('publication-categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{category}/edit', 'edit')->name('edit');
        Route::put('/{category}', 'update')->name('update');
        Route::delete('/{category}', 'destroy')->name('destroy');
    });

    Route::controller(AdminPublicationController::class)->prefix('publications')->name('publications.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{publication}/edit', 'edit')->name('edit');
        Route::put('/{publication}', 'update')->name('update');
        Route::delete('/{publication}', 'destroy')->name('destroy');
    });

    

});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

    Route::get('/', function () {
        return redirect()->route('locale.home', ['locale' => 'id']);
    });

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

