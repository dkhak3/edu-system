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
Route::get('/courses/all', [CoursesController::class,'all']);
Route::get('/courses/search',[CoursesController::class,'search']);
Route::post('/courses/delete/selected',[CoursesController::class,'delete']);
Route::delete('/courses/delete/{id}',[CoursesController::class,'destroy']);

//Subject
Route::get('/getAllSubject',[SubjectsController::class,'search']);
Route::get('/getAll',[SubjectsController::class,'getAll']);
// Route::get('/search?keyword={keyword}',[SubjectsController::class,'search']);
// Route::get('/getAllSubjectZA',[SubjectsController::class,'getAllZa']);
// Route::get('/getSearchSubject',[SubjectsController::class,'search']);
// Route::get('/cancelSubject', [SubjectsController::class,'index']);


// Route::get('/indexSubject', [SubjectsController::class,'index']);
// Route::get('/addSubject', [SubjectsController::class,'add']);
// Route::post('/add-subjects',[SubjectsController::class,'store']);

// Route::get('/editSubject/{id}', [SubjectsController::class,'editSubject']);
// Route::get('/edit/showSubject/{id}', [SubjectsController::class,'show']);
// Route::put('/edit-subject/{id}',[SubjectsController::class,'update']);
Route::delete('/deleteSubject/{id}',[SubjectsController::class,'destroy']);
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
