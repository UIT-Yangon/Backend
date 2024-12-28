<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OrgCollaboration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use HTMLPurifier;
use HTMLPurifier_Config;


class OrgCollaborationController extends Controller
{
    public function list()
    {
        $query = OrgCollaboration::query();
        $organization = $query->orderBy('id', 'asc')->paginate(10);
        return view('collaboration.orgcollaboration_list', compact('organization'));
    }

    public function create()
    {
        return view('collaboration.orgcollaboration_create');
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

        $organization = new OrgCollaboration();
        $organization->name = $Name;
        $organization->country = $Country;
        $organization->link = $Link;

        $organization->save();
        return redirect()->route('org#list')->with('success', 'Organization added successfully!');
    }

    public function edit($id)
    {
        $organization = OrgCollaboration::findOrFail($id);
        return view('collaboration.orgcollaboration_edit', compact('organization'));
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

        $organization = OrgCollaboration::findOrFail($id);

        $organization->update([
            'name' => $purifier->purify($request->name),
            'country' => $purifier->purify($request->country),
            'link' => $purifier->purify($request->link), 
        ]);

        return redirect()->route('org#list')->with('success', 'Organization updated successfullly!');

    }

    public function delete($id)
    {
        $organization = OrgCollaboration::find($id);

        if (!$organization) {
            return redirect()->route('org#list')->with('error', 'Organization not found!');
        }

        $organization->delete();
        return redirect()->route('org#list')->with('success', 'Organization deleted successfully!');
    }
}
