<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

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
Route::post('/upload', [UploadController::class, 'upload'])->name('uploading');
Route::get('/forms', [UploadController::class, 'index']);
Route::post('/forms', [UploadController::class, 'uploading'])->name('imguploading');

