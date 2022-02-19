<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\MessageController;

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

Route::view('/', 'welcome')->name('welcome');
Route::view('docs', 'swagger.index')->name('docs');

Route::group(['as' => 'messages.', 'prefix' => 'messages'], function () {
    Route::middleware('auth')->group(function () {
        Route::get('', [MessageController::class, 'index'])->name('index');
        Route::post('{message}/resend', [MessageController::class, 'resend'])->name('resend');
    });
});

Route::view('/dashboard', 'main-dashboard')
    ->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
