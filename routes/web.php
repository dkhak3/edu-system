<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\SubjectsController;
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

//Subjects
Route::get('/subjects', [SubjectsController::class, 'index'])->name('subject');

Route::get('/addSubject', [SubjectsController::class, 'create'])->name('addSubject');
Route::post('/newSubject', [SubjectsController::class, 'store'])->name('newSubject');
// Route::delete('/subjects/{id}', [SubjectsController::class, 'destroy'])->name('deleteSubject');
Route::get('/updateSubject/{id}', [SubjectsController::class, 'edit'])->name('updateSubject');
Route::put('/editSubject/{id}', [SubjectsController::class, 'update'])->name('editSubject');
Route::get('/search', [SubjectsController::class, 'search'])->name('searchSubject');

//
// Route::get('/subjects', function () {
//     return view('layout');
// })->name('subject');