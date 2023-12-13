<?php

use App\Http\Controllers\Api\CommentController;
use Illuminate\Support\Facades\Route;

Route::post('/comments', [CommentController::class, 'store']);
