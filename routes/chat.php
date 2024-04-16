<?php

use App\Http\Controllers\User\ChatController;
use Illuminate\Support\Facades\Route;

Route::prefix('chat')->group(function () {
    Route::get('/{user_id}', [ChatController::class, 'chatForm'])->name('chat');
});
