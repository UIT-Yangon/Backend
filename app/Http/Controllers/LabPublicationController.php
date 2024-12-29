<?php

namespace App\Http\Controllers;

use App\Models\LabPublication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use HTMLPurifier;
use HTMLPurifier_Config;

class LabPublicationController extends Controller
{
    public function list(){
        $query = LabPublication::query();
        $data = $query->orderBy('created_at', 'asc')->paginate(10); 
        return view('publications.publication_list',['data' => $data]);
    }

    public function createPage(){
        return view('publications.publication_create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'link' => 'required|string',
            'lab' => 'required|string',
            'date' => 'required|string',
        ])->validate();

            $purifierConfig = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($purifierConfig);

            $title = $purifier->purify($request->title);
            $link = $purifier->purify($request->link);
            $date = $purifier->purify($request->date);
            $lab = $purifier->purify($request->lab);

            $labpublication = new LabPublication();
            $labpublication->title = $title;
            $labpublication->link = $link;
            $labpublication->date = $date;
            $labpublication->lab = $lab;

            $labpublication->save();

            return redirect()->route('publication#list')->with('success', 'Lab Publication added successfully');
    }

    public function delete($id){
        $labpublication = LabPublication::findOrFail($id);
        $labpublication->delete();
        return redirect()->route('publication#list')->with('success', 'Lab Publication deleted successfully');
    }
}
