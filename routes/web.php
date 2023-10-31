<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;

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

Route::get('/folders', function () {
    return view('folders');
})->middleware(['auth', 'verified'])->name('folders ');

Route::middleware('auth')->group(function () {
    // Alltemplates middleware start
    Route::Post('/folders/create', [UploadController::class, 'Foldercreate'])->name('foldercreate');
    Route::delete('/pictures/delete/{id}', [UploadController::class, 'delete'])->name('delete.picture');
    Route::Post('/pictures/addimage', [UploadController::class, 'insertImage'])->name('insert.Image');
    // Route::GET('/pictures/show/{id}', [UploadController::class, 'ShowImage'])->name('show.Image');
    Route::get('/folders', [UploadController::class, 'show'])->name('folders.show');
    Route::get('/folders/{id}/{folder_name}', [UploadController::class, 'foldersimgshow'])->name('foldersId');
    Route::post('/folders/delete', [UploadController::class, 'foldersdestroy'])->name('folderdestroy');


    Route::post('/upload', [UploadController::class, 'upload'])->name('uploading');
 // Alltemplates middleware end
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/forms', [UploadController::class, 'index']);
// Route::post('/forms', [UploadController::class, 'uploading'])->name('imguploading');

// Route::get('/folders/img', [UploadController::class, 'moveimgfolder'])->name('moveimgfolder');
// Route::Post('/folders/img', [UploadController::class, 'Move'])->name('picture.move');



require __DIR__ . '/auth.php';
