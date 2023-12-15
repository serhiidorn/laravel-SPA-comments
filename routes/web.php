<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'app');

Route::get('/download', [FileController::class, 'download']);
