<?php

use App\Http\Controllers\Api\ImageUploadController;
use Illuminate\Support\Facades\Route;

Route::post('/uploadimage', [ImageUploadController::class, 'store'])->name('upload.educational.image');
