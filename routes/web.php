<?php

use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UploadFileController::class, 'index'])->name('upload.index');
Route::post('/store', [UploadFileController::class, 'store'])->name('upload.store');
Route::get('/delete/{id}', [UploadFileController::class, 'delete'])->name('upload.delete');
Route::get('/download/{id}', [UploadFileController::class, 'download'])->name('upload.download');
