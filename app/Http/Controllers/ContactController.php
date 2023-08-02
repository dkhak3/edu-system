<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allContacts = Contact::orderBy('created_at', 'desc')->paginate(3);
        return view('contact.index')->with('allContacts', $allContacts);
    }

    public function loadDataTable()
    {
        $allContacts = Contact::orderBy('created_at', 'desc')->paginate(3);
        return response()->json(['allContacts' => $allContacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'regex: /^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$/'],
            'address' => ['required',],
            'phone' => ['required', 'regex: /^0{1}[0-9]{9}$/'],
            'birthday' => 'required'
        ]);
        Contact::create($data);
        return redirect('contacts')->with(['message' => 'You have successfully added contact.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $Contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Contact::find($id);
        if ($item) {
            //return response()->json(['item' => $item]);
            return view('contact.edit')->with('item', $item);
        }
        else {
            return response()->json(['message' => 'Contact Not Found!']);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Contact::find($id);
        if ($item) {
            $data = $request->validate([
                'name' => ['required', 'regex: /^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$/'],
                'address' => ['required',],
                'phone' => ['required', 'regex: /^0{1}[0-9]{9}$/'],
                'birthday' => 'required'
            ]);
            $item->update($data);
            return redirect('contacts')->with(['message' => 'You have successfully updated contact.']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Contact::find($id)){
            Contact::destroy($id);
            return redirect('contacts')->with(['message' => 'You have successfully deleted contact.']);
        }
    }

    public function destroyAllSelectedRecord(Request $request)
    {
        $ids = $request->ids;
        Contact::whereIn('id', $ids)->delete();
        $allContacts = Contact::orderBy('created_at', 'desc')->paginate(3);
        return response()->json([
            'message' => 'Delete all selected successfully!',
            'allContacts' => $allContacts,
            'pagination' => $allContacts->links()->toHtml()
        ]);
    }

    public function search(Request $request)
    {
        $result = [];
        if ($request->keywords != null) {
            $result = Contact::where('name', 'LIKE', '%' . $request->keywords . '%')->orderBy('created_at', 'desc')->paginate(3);
        }
        else {
            $result = Contact::orderBy('created_at', 'desc')->paginate(3);
        }
        return response()->json(['result' => $result]);
    }

    // Sort
    public function sort(Request $request)
    {
        $allContacts = Contact::orderBy($request->sortField, $request->sortType)->paginate(3);
        return response()->json([
            'allContacts' => $allContacts,
            'pagination' => $allContacts->links()->toHtml()
        ]);
        
    }

}
