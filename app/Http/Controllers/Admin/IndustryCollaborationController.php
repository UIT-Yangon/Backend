<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\IndustryCollaboration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use HTMLPurifier;
use HTMLPurifier_Config;


class IndustryCollaborationController extends Controller
{
    public function list()
    {
        $query = IndustryCollaboration::query();
        $industry = $query->orderBy('id', 'asc')->paginate(10);
        return view('collaboration.indcollaboration_list', compact('industry'));
    }

    public function create()
    {
        return view('collaboration.indcollaboration_create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
        ])->validate();

        $purifierConfig = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($purifierConfig);

        $Name = $purifier->purify($request->name);
        $Country = $purifier->purify($request->country);
        $Link = $purifier->purify($request->link);

        $industry = new IndustryCollaboration();
        $industry->name = $Name;
        $industry->country = $Country;
        $industry->link = $Link;

        $industry->save();
        return redirect()->route('ind#list')->with('success', 'Industry added successfully!');
    }

    public function edit($id)
    {
        $industry = IndustryCollaboration::findOrFail($id);
        return view('collaboration.indcollaboration_edit', compact('industry'));
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
        ])->validate();
        
        $purifierConfig = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($purifierConfig);

        $industry = IndustryCollaboration::findOrFail($id);

        $industry->update([
            'name' => $purifier->purify($request->name),
            'country' => $purifier->purify($request->country),
            'link' => $purifier->purify($request->link), 
        ]);

        return redirect()->route('ind#list')->with('success', 'Industry updated successfullly!');

    }

    public function delete($id)
    {
        $industry = IndustryCollaboration::find($id);

        if (!$industry) {
            return redirect()->route('ind#list')->with('error', 'Industry not found!');
        }

        $industry->delete();
        return redirect()->route('ind#list')->with('success', 'Industry deleted successfully!');
    }
}
