<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    public function index(Request $request)
    {
        $allLecturers = Lecturer::sortable()->paginate(5);
        return view('lecturer.index', compact('allLecturers'));
    }
    
    public function loadDataTableLecturer()
    {
        $allLecturers = Lecturer::orderBy('created_at', 'desc')->paginate(5);
        return response()->json(['allLecturers' => $allLecturers]);
    }

    public function create()
    {
        return view('lecturer.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
        ]);

        Lecturer::create($validatedData);
        return response()->json(['message' => 'Add new lecturer successfully!']);
    }

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
            return response()->json(['message' => 'Update lecturer successfully!']);
        }
        else {
            return response()->json(['message' => 'Lecturer Not Found!']);
        }
    }

    public function destroy(string $id)
    {
        if (Lecturer::find($id)){
            Lecturer::destroy($id);
            $allLecturers = Lecturer::orderBy('created_at', 'desc')->paginate(5);
            return response()->json([
                'allLecturers' => $allLecturers,
                'message' => 'You have successfully deleted Lecturer.'
            ]);
        }
    }

    public function deleteAll(Request $request) {
        $ids = $request->ids;
        Lecturer::whereIn('id', $ids)->delete();
        $allLecturers = Lecturer::orderBy('created_at', 'desc')->paginate(5);
        return response()->json([
            'message' => 'Delete all selected successfully!',
            'allLecturers' => $allLecturers
        ]);
    }

    public function destroyItemsSelected (Request $request)
    {
        $ids = $request->ids;
        Lecturer::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Delete items selected successfully']);
    }

    public function edit(string $id)
    {
        $item = Lecturer::find($id);
        if ($item) {
            return view('lecturer.edit')->with('item', $item);
        }
        else {
            return response()->json(['message' => 'Contact Not Found!']);
        }
    }

    public function search(Request $request)
    {
        $result = [];
        if ($request->keywords != null) {
            $result = Lecturer::where('name', 'LIKE', '%' . $request->keywords . '%')->orderBy('created_at', 'desc')->paginate(5);
        } else if ($request->keywords == null) {
            $result = Lecturer::orderBy('created_at', 'desc')->paginate(5);
        } else {
            return response()->json(['message' => 'Not Found!']);
        }
        
        return response()->json(['result' => $result]);
    }

    public function sortName(Request $request)
    {
        $allLecturers = [];
        if ($request->status == 0){
            $allLecturers = Lecturer::orderBy('name', 'asc')->paginate(5);
        }
        else {
            $allLecturers = Lecturer::orderBy('name', 'desc')->paginate(5);
        }
        return response()->json([
            'allLecturers' => $allLecturers
        ]);
    }

    public function sortCreatedAt(Request $request)
    {
        $allLecturers = [];
        if ($request->status == 0){
            $allLecturers = Lecturer::orderBy('created_at', 'asc')->paginate(5);
        }
        else {
            $allLecturers = Lecturer::orderBy('created_at', 'desc')->paginate(5);
        }
        return response()->json([
            'allLecturers' => $allLecturers
        ]);
    }
}