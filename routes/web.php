<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoursesController;
use App\Models\Course;

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

Route::get('/', function () {
    return view('dashboard');
});

// Lecturer
Route::get('/lecturers', [LecturerController::class,'index'])->name('index');
Route::get('lecturer/add', [LecturerController::class,'create'])->name('add');
Route::post('/lecturer/store', [LecturerController::class,'store'])->name('store');
Route::get('/lecturer/delete/{id}', [LecturerController::class,'destroy'])->name('delete');
Route::post('lecturer/edit/{id}', [LecturerController::class,'edit'])->name('edit');
Route::get('/lecturer/editScreen/{id}',[LecturerController::class,'editScreenLecturer'])->name("editScreenLecturer");
Route::delete("/lecturer/selected-lecturer", [LecturerController::class, 'deleteAll'])->name("deleteAll");

// Contact
Route::get('contacts/load-data-table', [ContactController::class, 'loadDataTable']);
Route::resource('contacts', ContactController::class);
Route::get('searchContacts', [ContactController::class, 'search']);
Route::delete('contacts-destroyAllSelectedRecord', [ContactController::class, 'destroyAllSelectedRecord'])->name('contacts.destroyAllSelectedRecord');
Route::get('sortContacts', [ContactController::class, 'sort']);

//Courses
Route::resource('courses',CoursesController::class);

//
Route::get('/subjects', function () {
    return view('layout');
})->name('subject');