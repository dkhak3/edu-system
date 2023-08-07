<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Session\Session;

class CoursesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $courses = new Course();
        session()->put('pageCourses',$request->page);
        session()->put('sortCourses',$request->sort);
        session()->put('keyCourses',$request->key);
       
        $search = Course::where('name','LIKE','%'.$request->key.'%');
        if ($request->sort == 'increaseName') {
            $search= $search->orderBy('name','asc');
        }else if ($request->sort == 'reduceName') {
            $search= $search->orderBy('name','desc');

        }else if ($request->sort == 'reduceTime') {
            $search= $search->orderBy('created_at','desc');

        }else if ($request->sort == 'increaseTime') {
            $search= $search->orderBy('created_at','asc');

        }
        $perPage = 4;
    $searchResult = $search->paginate($perPage, ['*'], 'page', $request->page);
    $search = $search->paginate($perPage, ['*'], 'page', $request->page);  
    $paginationLinks = $searchResult->links()->toHtml();
        $view =  View::make('componentChirld.tablelist')->with('courses', $search)->render();
            return  response()->json([
                'blade'=> $view,
                'courses'=> $courses->getAllUserIds(),
                'search'=>$search,
                'link'=>$paginationLinks
            ]);

    }
    
    public function index()
    {
        return view('courses.index');
        
    }
    
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('courses.add');
         
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
           
            
            return view('courses.add')->with('request',$request->all())->with('validate', $validate->errors()->messages());
            
        }else{
            $course = new Course($request->all());
        $course->save();
        $viewsc =  View::make('courses.success')->render();
        
        return redirect()->route('courses.index')->with('success', $viewsc);
    
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
       return view('courses.edit')->with('course',$course);
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
            $course = Course::find($id); 
            
            return view('courses.edit')->with('course',$course)->with('validate', $validate->errors()->messages());
        }
        $course = Course::find($id);
        $course->name = $request->name;
        $course->description = $request->description;
        $course->startdate = $request->startdate;
        $course->enddate = $request->enddate;
        $course->save();
        $viewsc =  View::make('courses.success')->render();
        
            return view('courses.index')->with('success', $viewsc);
        
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
    public function all() {
        $courses = new Course();
        return  response()->json([
            'courses'=> $courses->getAllUserIds(),
        ]);
    }
}