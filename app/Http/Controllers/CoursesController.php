<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CoursesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $courses = new Course();

        $search = Course::where('name','LIKE','%'.$request->key.'%');
        if ($request->sort == 'increaseName') {
            $search= $search->orderBy('name','asc');
        }else if ($request->sort == 'reduceName') {
            $search= $search->orderBy('name','desc');

        }
        $search= $search->paginate(4, ['*'], 'page', $request->page);
        $view =  View::make('componentChirld.tablelist')->with('courses', $search)->render();
            return  response()->json([
                'blade'=> $view,
                'courses'=> $courses->getAllUserIds(),
                'search'=>$search
            ]);

    }
    public function add()  {
        return view('courses.addcourses');
    }
    public function index()
    {
        
        $courses = Course::all();

        $view =  View::make('componentChirld.tablelist')->with('courses', $courses)->render();
            return  response()->json([
                'blade'=> $view,
                'courses'=> $courses
            ]);
    }
    public function getAll()
    {
        return view('courses.tablecourses')->with('courses',Course::all());

    }
    public function all() {
        $courses = new Course();
        return  response()->json([
            'courses'=> $courses->getAllUserIds(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=> 'required|max:191',
            'startdate'=>'required',
            'enddate'=>'required',
            'description'=>'required',
        ]);
        if ($validate->fails()) {
            $viewsc =  View::make('courses.error')->render();
            return  response()->json([
                'validate'=>$validate->errors()->messages(),
                'success'=>$viewsc
            ]);
        }else{
            $course = new Course($request->all());
        $course->save();
        $viewsc =  View::make('courses.success')->render();
            return  response()->json([
                
                'success'=>$viewsc,
            ]);
        }
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        return response()->json([
            'course'=> $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'name'=> 'required|max:191',
            'startdate'=>'required',
            'enddate'=>'required',
            'description'=>'required',
        ]);
        if ($validate->fails()) {
        $viewsc =  View::make('courses.error')->render();

            return response()->json([
                'validate'=>$validate->errors()->messages(),
                'success'=>$viewsc,



            ]);
        }
        $course = Course::find($id);
        $course->name = $request->name;
        $course->description = $request->description;
        $course->startdate = $request->startdate;
        $course->enddate = $request->enddate;
        $course->save();
        $viewsc =  View::make('courses.success')->render();
            return  response()->json([
                
                'success'=>$viewsc,
            ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            Course::find($id)->delete();
        
        $viewsc =  View::make('courses.success')->render();
            return  response()->json([
                
                'success'=>$viewsc
            ]);
            
        } catch (\Throwable $th) {
        
        $viewsc =  View::make('courses.error')->render();
            
            return response()->json([
                
                'success'=>$viewsc
            ]);
        }         
        
    }
    public function delete(Request $request)
    {
        
        $courses = new Course();
        try {
            Course::whereIN('id',$request->arrCourses)->delete();
           
            $viewsc =  View::make('courses.success')->render();

            return  response()->json([
                'courses'=>$courses->getAllUserIds(),
                'success'=>$viewsc
            ]);
            
        } catch (\Throwable $th) {
        
        $viewsc =  View::make('courses.error')->render();
        return  response()->json([
            'courses'=>$courses->getAllUserIds(),

            
            'success'=>$viewsc
        ]);
        }         
        
    }
}
