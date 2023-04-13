<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramBotController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [TelegramBotController::class, 'sendMessage']);
Route::POST('/send-message', [TelegramBotController::class, 'storeMessage']);
Route::get('/send-photo',  [TelegramBotController::class, 'sendPhoto']);
Route::post('/store-photo',  [TelegramBotController::class, 'storePhoto']);
Route::get('/updated-activity', [TelegramBotController::class, 'updatedActivity']);

