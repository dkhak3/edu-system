<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    public function index() {
        $lecturer = DB::table('lecturers')->paginate(5);
        return view('lecturer.index', compact('lecturer'));

    }

    public function create()
    {
        return view('lecturer.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lecturer_name' => 'required|max:191',
            'lecturer_address' => 'required|max:191',
            'lecturer_phone' => ["required", "regex:/^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/"],
            'lecturer_birthday' => 'required|date',
        ]);

        Lecturer::create($validatedData);
        return redirect()->route('index')->with('thongbao', 'Add new lecturer successfully');
    }

    public function edit($id, Request $request)
    {
        $validatedData = $request->validate([
            'lecturer_name' => 'required|max:191',
            'lecturer_address' => 'required|max:191',
            'lecturer_phone' => ["required", "regex:/^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/"],
            'lecturer_birthday' => 'required|date',
        ]);

        DB::table('lecturers')->where("id", $id)->update(['lecturer_name' => $validatedData['lecturer_name']]);
        DB::table('lecturers')->where("id", $id)->update(['lecturer_address' => $validatedData['lecturer_address']]);
        DB::table('lecturers')->where("id", $id)->update(['lecturer_phone' => $validatedData['lecturer_phone']]);
        DB::table('lecturers')->where("id", $id)->update(['lecturer_birthday' => $validatedData['lecturer_birthday']]);
        
        return redirect()->route('index')->with('thongbao', 'Update lecturer successfully');
    }

    public function editScreenLecturer($id)
    {
        $lecturer = DB::table('lecturers')->where('id', $id)->get();
        return view("lecturer.edit")->with('lecturer', $lecturer);
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $lecturer->update($request->all());
        return redirect()->view('lecturer.index');
    }

    public function destroy($id)
    {
        DB::table("lecturers")->where("id",$id)->delete();
        return redirect()->route('index')->with('thongbao', 'Delete lecturer successfully');
    }

    public function deleteAll(Request $request) {
        $ids = $request->ids;
        Lecturer::whereIn('id', $ids)->delete();
        return response()->json(["success" => "Lecturer have been deleted!"]);
    }

    public function search(Request $request){
        $lecturer = Lecturer::WHERE('lecturer_name','like','%'. $request->search.'%')
        ->orWHERE('lecturer_phone',$request->search)->get();
        return view('lecturer.search', compact('lecturer'));
    }
}
