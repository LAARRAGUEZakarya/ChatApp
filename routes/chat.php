<?php

use App\Http\Controllers\User\ChatController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/chat/{user_id}', [ChatController::class, 'chatForm'])->name('chat');
});
