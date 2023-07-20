<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allContacts=[];
        if ($request->keywords != null) {
            $allContacts = Contact::where('name', 'LIKE', '%' . $request->keywords . '%')->orderBy('created_at', 'desc')->paginate(3);
        }
        else {
            $allContacts = Contact::orderBy('created_at', 'desc')->paginate(3);
        }
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
        $data = $request->all();
        Contact::create($data);
        //return redirect('contacts')->with('message', 'Add successfully!');
        return response()->json(['message' => 'You have successfully added contact.']);
        //return view('contact.index');
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
            $item->update($request->all());
            return response()->json(['message' => 'Update successfully!']);
        }
        else {
            return response()->json(['message' => 'Contact Not Found!']);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Contact::destroy($id);
        //return redirect('contacts')->with('message', 'Delete successfully!');
        return response()->json(['message' => 'You have successfully deleted contact.']);
    }

    public function destroyItemsSelected (Request $request)
    {
        $ids = $request->ids;
        Contact::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Delete items selected successfully']);
    }

}
