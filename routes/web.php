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
Route::get('/lecturers', [LecturerController::class,'index'])->name('index');
Route::get('lecturer/add', [LecturerController::class,'create'])->name('add');
Route::post('/lecturer/store', [LecturerController::class,'store'])->name('store');
Route::get('/lecturer/delete/{id}', [LecturerController::class,'destroy'])->name('delete');
Route::post('lecturer/edit/{id}', [LecturerController::class,'edit'])->name('edit');
Route::get('/lecturer/editScreen/{id}',[LecturerController::class,'editScreenLecturer'])->name("editScreenLecturer");
Route::delete("/lecturer/selected-lecturer", [LecturerController::class, 'deleteAll'])->name("deleteAll");

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
Route::get('sortContacts', [ContactController::class, 'sort']);
// Route::get('sort-created_at', [ContactController::class, 'sortCreatedAt']);

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