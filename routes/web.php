<?php

use App\Http\Controllers\Admin\AwardCategoryController;
use App\Http\Controllers\Admin\AwardNomineesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\Settings\EventSettingsController;
use App\Http\Controllers\Admin\VotingVontroller;
use App\Http\Controllers\Web\AwardCategoriesController as WebAwardCategoriesController;
use App\Http\Controllers\Web\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['as' => 'web.'], function () {
    Route::get('/mail', [HomePageController::class, 'mail']);
    Route::get('/participation-confirmation/{id}/{category}', [HomePageController::class, 'participation_confirmation'])->name('participation_confirmation');
    Route::post('/participation-confirmation/{id}/{category}', [HomePageController::class, 'participation_confirmation_store'])->name('participation_confirmation.store');
    Route::get('/', [HomePageController::class, 'index'])->name('index');
    Route::get('/privacy-policy', [HomePageController::class, 'privacy_policy'])->name('privacy_policy');
    Route::get('/nominee', [HomePageController::class, 'nominee']);
    Route::get('/about-us', [HomePageController::class, 'aboutUs'])->name('about-us');
    Route::get('/contact-us', [HomePageController::class, 'contactUs'])->name('contact-us');
    Route::post('/contact-us', [HomePageController::class, 'contactUsStore'])->name('contact-us.store');
    Route::group(['prefix' => 'awards', 'as' => 'awards.'], function () {
        Route::get('categories', [WebAwardCategoriesController::class, 'categories'])->name('categories.index');
        Route::get('categories/{category}', [WebAwardCategoriesController::class, 'category'])->name('categories.show');
        Route::get('registration', [WebAwardCategoriesController::class, 'registration'])->name('registration.index');
        Route::post('registration', [WebAwardCategoriesController::class, 'registration_store'])->name('registration.store');
        Route::resource('votes', VoteController::class);
    });
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:superadministrator|administrator']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('award-category', AwardCategoryController::class);
    Route::resource('award-nominee', AwardNomineesController::class);
    Route::resource('award-voting', VotingVontroller::class);


    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::resource('events', EventSettingsController::class);
    });
});
