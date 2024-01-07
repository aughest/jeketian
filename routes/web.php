<?php

use App\Http\Controllers\WebController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/live-room', [WebController::class, 'live_room'])->name('live-room');
Route::get('/send-mess', [WebController::class, 'send_mess'])->name('send-mess');
Route::get('/send-photo', [WebController::class, 'send_photo'])->name('send-photo');
