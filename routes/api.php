<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::post('/chat', [ChatController::class, 'store'])->middleware('throttle:20,1');
