<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allLecturers=[];
        if ($request->search != null) {
            $allLecturers = Lecturer::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWHERE('phone',$request->search)
            ->orWHERE('address',$request->search)
            ->orWHERE('birthday',$request->search)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        }
        else {
            // $allLecturers = Lecturer::orderBy('created_at', 'desc')->paginate(5);
            $allLecturers = Lecturer::sortable()->paginate(5);
        }
        // return view('lecturer.index')->with('allLecturers', $allLecturers);
        return view('lecturer.index', compact('allLecturers'));
    }
    

    public function search(Request $request){
        $lecturer = Lecturer::WHERE('name','like','%'. $request->search.'%')
        ->orWHERE('phone',$request->search)->get();
        return view('lecturer.search', compact('lecturer'));
    }

    public function loadDataTableLecturer()
    {
        $allLecturers = Lecturer::orderBy('created_at', 'desc')->paginate(3);
        return response()->json(['allLecturers' => $allLecturers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lecturer.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $data = $request->all();
    //     Lecturer::create($data);
    //     //return redirect('contacts')->with('message', 'Add successfully!');
    //     return response()->json(['message' => 'Add successfully!']);
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
        ]);

        Lecturer::create($validatedData);
        return response()->json(['message' => 'Add successfully!']);
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
        $lecturer = Lecturer::find($id);
        return response()->json([
            'lecturer'=> $lecturer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Lecturer::find($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
        ]);

        if ($item) {
            $item->update($validatedData);
            return response()->json(['message' => 'Update successfully!']);
        }
        else {
            return response()->json(['message' => 'Contact Not Found!']);
        }
    }


    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    //     $validate = Validator::make($request->all(),[
    //         'name' => 'required',
    //         'address' => 'required',
    //         'phone' => 'required',
    //         'birthday' => 'required',
    //     ]);
    //     if ($validate->failed()) {
    //         return response()->json([
    //         'validate'=>$validate->errors()->messages(),
    //         'success'=>false

    //         ]);
    //     }
    //     $Lecturer = Lecturer::find($id);
    //     $Lecturer->name = $request->name;
    //     $Lecturer->address = $request->address;
    //     $Lecturer->phone = $request->phone;
    //     $Lecturer->birthday = $request->birthday;
    //     $Lecturer->save();

    //     $Lecturers = Lecturer::all();
    //     return response()->json([
    //         'Lecturers'=> $Lecturers,
    //         'success'=>true
    //     ]);
    // }

    public function editLecturer($id)  {
        return view('Lecturer.edit')->with('id',$id);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Lecturer::destroy($id);
        //return redirect('contacts')->with('message', 'Delete successfully!');
        return response()->json(['message' => 'Delete successfully!']);
    }

    public function deleteAll(Request $request) {
        $ids = $request->ids;
        Lecturer::whereIn('id', $ids)->delete();
        return response()->json(["success" => "Lecturer have been deleted!"]);
    }

    public function destroyItemsSelected (Request $request)
    {
        $ids = $request->ids;
        Lecturer::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Delete items selected successfully']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add()  {
        return view('lecturer.add');
    }

}