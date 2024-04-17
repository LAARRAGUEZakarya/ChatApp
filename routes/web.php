<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ChatController;

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
})->name('/');



 Route::middleware(['auth'])->get('chat',function(){
    return view('chatList');
 })->name('chatList');

 Route::middleware(['auth'])->get('chatForm/{user_id}', [ChatController::class, 'chatForm'])->name('chatForm');
 Route::middleware(['auth'])->post('sendMessage', [ChatController::class, 'sendMessage'])->name('sendMessage');

require __DIR__.'/auth.php';
