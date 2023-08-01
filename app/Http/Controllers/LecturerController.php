<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    public function index(Request $request) {
        $lecturers=[];
        if ($request->search != null) {
            $lecturers = Lecturer::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWHERE('phone',$request->search)
            ->sortable()
            ->paginate(5);
        }
        else if ($request->search == null) {
            $lecturers = Lecturer::sortable()->paginate(5);
        }
        return view('lecturer.index')->with('lecturers', $lecturers);
    }

    public function create()
    {
        return view('lecturer.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ["required", "regex:/^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$/", "max:191"],
            'address' => 'required|max:191',
            'phone' => ["required", "regex:/^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/", "max:191"],
            'birthday' => 'required|date|max:191',
        ]);

        Lecturer::create($validatedData);
        return redirect()->route('index')->with('thongbao', 'Add new lecturer successfully');
    }

    public function edit($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => ["required", "regex:/^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$/", "max:191"],
            'address' => 'required|max:191',
            'phone' => ["required", "regex:/^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/", "max:191"],
            'birthday' => 'required|date|max:191',
        ]);

        DB::table('lecturers')->where("id", $id)->update(['name' => $validatedData['name']]);
        DB::table('lecturers')->where("id", $id)->update(['address' => $validatedData['address']]);
        DB::table('lecturers')->where("id", $id)->update(['phone' => $validatedData['phone']]);
        DB::table('lecturers')->where("id", $id)->update(['birthday' => $validatedData['birthday']]);
        
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
        $lecturers = Lecturer::sortable()->paginate(5);
        return response()->json([
            "success" => "Lecturer have been deleted!",
            "lecturers" => $lecturers
        ]);
        
    }
}