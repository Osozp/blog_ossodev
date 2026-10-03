<?php

use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriberController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::post('/subscribe', [SubscriberController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('subscribe');

Route::get('subscribe/confirm/{subscriber}', [SubscriberController::class, 'confirm'])
    ->name('subscribe.confirm')
    ->middleware('signed');

Route::get('subscribe/unsubscribe/{subscriber}',[SubscriberController::class, 'unsubscribe'])
    ->name('subscribe.unsubscribe')
    ->middleware('signed');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('posts', PostController::class)->except(['show']);
        Route::resource('pages', PageController::class)->except(['show']);

        Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');

        Route::get('/settings/email', [SettingController::class, 'editEmail'])->name('settings.email.edit');
        Route::post('/settings/email', [SettingController::class, 'updateEmail'])->name('settings.email.update');

        Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
        Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
        Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
        Route::post('/campaigns/{campaign}/send', [CampaignController::class, 'send'])->name('campaigns.send');

        Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
        Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
        Route::delete('/campaigns/{campaign}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');

        Route::resource('/home', HomeAdminController::class);
        Route::patch('/home/{home}', [HomeAdminController::class, 'update'])->name('home.update');
    });
});


Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');

require __DIR__ . '/settings.php';
