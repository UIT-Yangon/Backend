<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UniCollaboration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use HTMLPurifier;
use HTMLPurifier_Config;

class UniCollaborationController extends Controller
{
    // public function home()
    // {
    //     $universities = UniCollaboration::all(); // Fetch all universities
    //     return view('home', compact('universities')); // Pass data to the view
    // }

    public function list()
    {
        $query = UniCollaboration::query();
        $universities = $query->orderBy('id', 'asc')->paginate(10);
        return view('collaboration.unicollaboration_list', compact('universities'));
    }

    public function create()
    {
        return view('collaboration.unicollaboration_create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
        ])->validate();

        $purifierConfig = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($purifierConfig);

        $Name = $purifier->purify($request->name);
        $Country = $purifier->purify($request->country);
        $Link = $purifier->purify($request->link);

        $university = new UniCollaboration();
        $university->name = $Name;
        $university->country = $Country;
        $university->link = $Link;

        $university->save();
        return redirect()->route('uni#list')->with('success', 'University added successfully!');
    }


    public function edit($id)
    {
        $university = UniCollaboration::findOrFail($id);
        return view('collaboration.unicollaboration_edit', compact('university'));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
        ])->validate();
        
        $purifierConfig = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($purifierConfig);

        $university = UniCollaboration::findOrFail($id);

        $university->update([
            'name' => $purifier->purify($request->name),
            'country' => $purifier->purify($request->country),
            'link' => $purifier->purify($request->link), 
        ]);

        return redirect()->route('uni#list')->with('success', 'University updated successfullly!');

    }



    public function delete($id)
    {
        $university = UniCollaboration::find($id);

        if (!$university) {
            return redirect()->route('uni#list')->with('error', 'University not found!');
        }

        $university->delete();
        return redirect()->route('uni#list')->with('success', 'University deleted successfully!');
    }

}
