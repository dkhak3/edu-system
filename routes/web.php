<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ContactController;
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
    return view('layout');
});


// Lecturer
Route::resource('lecturers', LecturerController::class);
Route::get('loadDataTableLecturer', [LecturerController::class, 'loadDataTableLecturer']);
Route::get('lecturers/create', [LecturerController::class, 'create']);
Route::post('lecturers/store', [LecturerController::class, 'store']);
Route::get('lecturers/edit/{id}', [LecturerController::class, 'edit']);
Route::put('lecturers/update/{id}', [LecturerController::class, 'update']);
Route::delete('delete-lecturer/{id}', [LecturerController::class, 'destroy']);
Route::delete("/lecturer/selected-lecturer", [LecturerController::class, 'deleteAll'])->name("deleteAll");
Route::get('searchLecturers', [LecturerController::class, 'search']);
// Route::get('sortLecturersName', [LecturerController::class, 'sortName']);
// Route::get('sortLecturersCreatedAt', [LecturerController::class, 'sortCreatedAt']);

// Contact ---------------------------------------------------------------------------------------
Route::get('contacts/load-data-table', [ContactController::class, 'loadDataTable']);
Route::resource('contacts', ContactController::class);
Route::get('contacts/create', [ContactController::class, 'create']);
Route::post('contacts/store', [ContactController::class, 'store']);
Route::delete('contacts/destroy/{id}', [ContactController::class, 'destroy']);
Route::get('contacts/edit/{id}', [ContactController::class, 'edit']);
Route::put('contacts/update/{id}', [ContactController::class, 'update']);
Route::get('searchContacts', [ContactController::class, 'search']);
Route::delete('contacts-destroyAllSelectedRecord', [ContactController::class, 'destroyAllSelectedRecord'])->name('contacts.destroyAllSelectedRecord');
// Sort
Route::get('sort-name', [ContactController::class, 'sortName']);
Route::get('sort-created_at', [ContactController::class, 'sortCreatedAt']);

// ------------------------------------------------------------------------------------------------

//Courses
Route::get('/courses', function () {
    
    return view('layout');
})->name('courses');
Route::get('/courses/add/form', function () {
    
    return view('layout');
})->name('courses');
//
Route::get('/subjects', function () {
    return view('layout');
})->name('subject');




