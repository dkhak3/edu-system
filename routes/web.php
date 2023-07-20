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
// Route load data table by Ajax
Route::get('loadDataTableLecturer', [LecturerController::class, 'loadDataTableLecturer']);
// Route add by Ajax
Route::post('lecturers', [LecturerController::class, 'store']);
// Route delete by Ajax
Route::delete('delete-lecturer/{id}', [LecturerController::class, 'destroy']);
Route::delete('contacts-destroyItemsSelected', [ContactController::class, 'destroyItemsSelected'])->name('destroyItemsSelected');
Route::delete("/lecturer/selected-lecturer", [LecturerController::class, 'deleteAll'])->name("deleteAll");


// Contact ---------------------------------------------------------------------------------------
// Route load data table by Ajax
Route::get('loadDataTable', [ContactController::class, 'loadDataTable']);
// Route get index
Route::resource('contacts', ContactController::class);
// Route change into add page
Route::get('contacts/create', [ContactController::class, 'create']);
// Route add by Ajax
Route::post('contacts', [ContactController::class, 'store']);
// Route delete by Ajax
Route::delete('delete-contact/{id}', [ContactController::class, 'destroy']);
//Route update by Ajax
Route::get('edit-contact/{id}', [ContactController::class, 'edit']);
Route::put('update-contact/{id}', [ContactController::class, 'update']);
Route::delete('contacts-destroyItemsSelected', [ContactController::class, 'destroyItemsSelected'])->name('destroyItemsSelected');

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
    return view('subject.subjects');
})->name('subject');




