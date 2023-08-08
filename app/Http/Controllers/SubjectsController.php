<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request) {
       
        $sort = $request->input('sort');
        $keyword = $request->input('keyword');

        $query = Subject::query();

        // Áp dụng tìm kiếm nếu có từ khóa
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
                // ->orWhere('description', 'like', '%' . $keyword . '%');
        }



        if ($sort == 'Az') {
            $query->orderBy('name', 'asc');
        }
        if ($sort == 'Za'){
            $query->orderBy('name', 'desc');
        }
        // else{
        //     // $query->orderBy('id', 'asc');
        // }

        // Lấy danh sách subjects dùng paginate
       

        $perPage = 3;
        // $searchResult = $search->paginate($perPage, ['*'], 'page', $request->page);
        $subjects = $query->paginate($perPage, ['*'], 'page', $request->page);
        // Trích xuất thông tin cần thiết từ đối tượng phân trang
        $paginationLinks = $subjects->links()->toHtml();
            

        return response()->json([
            'subjects'=> $subjects,
            'link' => $paginationLinks  
        ]);
    }
    public function index()
    {
       
        $subjects = Subject::paginate(3); // Lấy 10 môn học mỗi trang
        // dd($subjects);
        return view('subject.subjects', compact('subjects'));
     
    }
    public function getAll()
    {
        // $subjects = Subject::all();

        // if ($request->sort == 'increaseName') {
        //     $subjects = Subject::orderBy('name', 'asc')->get();
        //     return response()->json([
        //         'subjects'=> $subjects
        //     ]);
        // }
        // else if ($request->sort == 'reduceName'){
        //     $subjects = Subject::orderBy('name', 'desc')->get();
        //     return response()->json([
        //         'subjects'=> $subjects
        //     ]);
        // }
       
        $subjects = Subject::all();
            return response()->json([
                'subjects'=> $subjects
            ]);
    
    }
    public function getAllZa()
    {
        // $subjects = Subject::all();
        // $subjects= $subjects->orderBy('name','asc');
        $subjects = Subject::orderBy('name', 'desc')->get();
        return response()->json([
            'subjects'=> $subjects
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
        return view('subject.addSubject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add()  {
        // return view('subject.addSubject');

        $subjects = Subject::all();
        //
        return view('subject.addSubject')->with('zzz',$subjects);

    }
    public function editSubject($id)  {
        // return view('subject.updateSubject')->with('id',$id);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nameInput' => 'required|max:255',
            'desInput' => 'required',
        ]);
        // Xử lý lưu dữ liệu môn học mới từ $request
        $subject = new Subject();
            $subject->name = $request->input('nameInput');
            $subject->description = $request->input('desInput');
            $subject->save();

        // Sau khi lưu dữ liệu, bạn có thể chuyển hướng người dùng đến trang danh sách môn học
        return redirect()->route('subject')->with('success', 'Subject has been added successfully.');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $subject = Subject::find($id);
        return response()->json([
            'subject'=> $subject
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
        //
          // Lấy thông tin môn học từ ID
        $subject = Subject::findOrFail($id);
        return view('subject.updateSubject', compact('subject'));
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
        //
        // $validate = Validator::make($request->all(),[
        //     'name'=> 'required:max:191',
        //     'description'=>'required:max:191',
        // ]);
        // if ($validate->failed()) {
        //     return response()->json([
        //     'validate'=>$validate->errors()->messages(),
        //     'success'=>false

        //     ]);
        // }
        // $subject = Subject::find($id);
        // $subject->name = $request->name;
        // $subject->description = $request->description;
        // $subject->save();

        // $subjects = Subject::all();
        // return response()->json([
        //     'subjects'=> $subjects,
        //     'success'=>true
        // ]);
        $request->validate([
            'nameInput' => 'required|max:255',
            'desInput' => 'required',
        ]);

        // Lấy thông tin môn học từ ID
        $subject = Subject::findOrFail($id);

        // Cập nhật thông tin môn học từ dữ liệu được gửi từ form
        $subject->name = $request->input('nameInput');
        $subject->description = $request->input('desInput');
        $subject->save();

        // Chuyển hướng về trang danh sách môn học hoặc trang chi tiết môn học nếu cần
        return redirect()->route('subject')->with('success', 'Subject has been updated successfully.');
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
            Subject::find($id)->delete();
            $subjects = Subject::all();
            return response()->json([
                'subjects'=> $subjects,
                'success'=>true
            ]);
            
        } catch (Throwable $th) {
        $subjects = Subject::all();
            return response()->json([
                'subjects'=> $subjects,
                'success'=>false
            ]);
        }     
        // $subject = Subject::findOrFail($id);
        // $subject->delete();

        // return redirect()->route('subject')->with('success', 'Subject has been deleted successfully.');
    }
    public function delete($id)
    {
      
        // $data = Subject::find($id);
        // $data->delete();
        // return redirect('subject');
        
        // try {
        //     Subject::whereIN('id',$arr)->delete();
        //     $subjects = Subject::all();
        //     return response()->json([
        //         'subjects'=> $subjects,
        //         'success'=>true
        //     ]);
            
        // } catch (\Throwable $th) {
        // $subjects = Subject::all();
            
        //     return response()->json([
        //         'subjects'=> $subjects, 
        //         'success'=>false
        //     ]);
        // }  
          
        
    }
    public function searchby(Request $request)
    {
        $subjects = Subject::where('name','LIKE','%'.$request->key.'%');
        return response()->json([
            'subjects'=> $subjects
        ]);
    }

}
