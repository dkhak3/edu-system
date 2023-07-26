<?php

use App\Http\Controllers\API\CoursesAPIController as APICoursesAPIController;
use App\Http\Controllers\API\CoursesAPIController;

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LecturerController;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Courses
Route::get('/courses/add/form', [CoursesController::class,'create']);
Route::get('/courses/all', [CoursesController::class,'all']);
Route::get('/courses', [CoursesController::class,'index']);
Route::get('/courses/index', function () {
    
    return view('courses.tablecourses');
})->name('courses');

Route::get('/courses/search',[CoursesController::class,'search']);
Route::get('/courses/getall',[CoursesController::class,'getAll']);
Route::post('/courses/add-course',[CoursesController::class,'store']);
Route::post('/courses/delete/selected',[CoursesController::class,'delete']);
Route::delete('/courses/delete/{id}',[CoursesController::class,'destroy']);
Route::post('/courses/delete/courses/all',[CoursesController::class,'delete']);
Route::post('/courses/edit/show/{id}',[CoursesController::class,'show']);
Route::put('/courses/update-course/{id}',[CoursesController::class,'update']);
//Subject
Route::get('/getAllSubject',[SubjectsController::class,'getAll']);
Route::get('/getAllSubjectZA',[SubjectsController::class,'getAllZa']);
Route::get('/getSearchSubject',[SubjectsController::class,'search']);
Route::get('/cancelSubject', [SubjectsController::class,'index']);


Route::get('/indexSubject', [SubjectsController::class,'index']);
Route::get('/addSubject', [SubjectsController::class,'add']);
Route::post('/add-subjects',[SubjectsController::class,'store']);

Route::get('/editSubject/{id}', [SubjectsController::class,'editSubject']);
Route::get('/edit/showSubject/{id}', [SubjectsController::class,'show']);
Route::put('/edit-subject/{id}',[SubjectsController::class,'update']);
Route::delete('/deleteSubject/{id}',[SubjectsController::class,'destroy']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Lecturers
Route::get('/lecturers/addLecturer', [LecturerController::class,'add']);
Route::get('/lecturers/editLecturer/{id}', [LecturerController::class,'editLecturer']);
Route::get('/lecturers/edit/showLecturer/{id}', [LecturerController::class,'show']);
Route::put('/lecturers/edit-lecturer/{id}',[LecturerController::class,'update']);
Route::get('/lecturers/cancelLecturer', [LecturerController::class,'index']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

