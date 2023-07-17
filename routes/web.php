<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ContactController;

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

// Lecturer
Route::get('/lecturer', [LecturerController::class,'index'])->name('index');
Route::get('lecturer/add', [LecturerController::class,'create'])->name('add');
Route::get('/lecturer/delete/{id}', [LecturerController::class,'destroy'])->name('delete');
Route::post('lecturer/edit/{id}', [LecturerController::class,'edit'])->name('edit');
Route::post('/lecturer/store', [LecturerController::class,'store'])->name('store');
Route::get('/lecturer/editScreen/{id}',[LecturerController::class,'editScreenLecturer'])->name("editScreenLecturer");
Route::get('/lecturer/search', [LecturerController::class,'search'])->name('search');
Route::delete("/lecturer/selected-lecturer", [LecturerController::class, 'deleteAll'])->name("deleteAll");

// Contact
Route::resource('contacts', ContactController::class);
Route::post('contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::delete('contacts-destroyItemsSelected', [ContactController::class, 'destroyItemsSelected'])->name('destroyItemsSelected');