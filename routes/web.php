<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/test', 'welcome')->name('moman');


Route::layout('layouts.auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::livewire('/', 'auth.login')
            ->name('login');


    });

    Route::livewire('password/reset', 'auth.passwords.email')
        ->name('password.request');

    Route::livewire('password/reset/{token}', 'auth.passwords.reset')
        ->name('password.reset');

    Route::middleware('auth')->group(function () {
        Route::livewire('email/verify', 'auth.verify')
            ->middleware('throttle:6,1')
            ->name('verification.notice');

        Route::livewire('password/confirm', 'auth.passwords.confirm')
            ->name('password.confirm');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('logout',function (){
            auth()->logout();
            return redirect(route('home'));
        })->name('admin.logout');
       // Route::get('/', 'DashboardController@index')->name('home');
        Route::post('/question/save', 'DashboardController@questionSave')->name('answer.save');
        Route::post('/permision_role/save', 'DashboardController@role_save')->name('permision_role.save');
        Route::post('/permision_role/update/{role}', 'DashboardController@role_update')->name('permision_role.update');
        Route::post('/question/{question}', 'DashboardController@questionUpdate')->name('answer.update');

        Route::layout('admin_layout.main')->group(function () {
            Route::livewire('/', 'dashboard')
                ->name('home');
            Route::livewire('delegates/form', 'delegates.form')
                ->name('delegates.form');
            Route::livewire('delegates/index', 'delegates.index')
                ->name('delegates.index');
            Route::livewire('cities', 'city')
                ->name('cities.index');
            Route::livewire('regins', 'regoin')
                ->name('regins.index');
            Route::livewire('question', 'question-live-wired')
                ->name('question.index');

            Route::livewire('user', 'user-component')
                ->name('user.index');

            Route::livewire('role', 'role-component')
                ->name('role.index');
            Route::livewire('profile', 'profile-component')
                ->name('profile.index');

            Route::livewire('customer', 'customer-componet')
                ->name('customer.index');
            Route::livewire('offer', 'offer-component')
                ->name('offer.index');

            Route::livewire('offer/create', 'offer-form-component')
                ->name('offer.create');




        });
    });
});



Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', 'Auth\EmailVerificationController')
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', 'Auth\LogoutController')
        ->name('logout');
});


Route::get('/developer_test', function() {
    $user = "Customer_1";
    $class ='App\Customer';
    $name = new $class;
    dd($name::find(1));
});