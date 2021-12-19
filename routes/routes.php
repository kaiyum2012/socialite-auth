<?php


use Illuminate\Support\Facades\Route;
use Kaiyum2012\SocialiteAuth\Http\Controllers\SocialAuthController;

Route::group(['middleware' => 'web'], function () {
    Route::get(config('socialite-auth.route'), [SocialAuthController::class, 'redirect'])->name('socialite-auth.login');
    Route::get(config('socialite-auth.callback'), [SocialAuthController::class, 'authenticated'])->name('socialite-auth.callback');
});
