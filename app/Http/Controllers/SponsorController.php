<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SponsorController extends Controller
{
    public function sponsorPage($id){
        // dd($id);
        $sponsors = Sponsor::where('conf_id',$id)->get();
        return view('sponsor.sponsor',compact('sponsors','id'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'link' => 'required|string',
            // 'user_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10000', // Example validation rules for images
        ])->validate();
        // dd($request->toArray());
        $path = "";
        if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                // $$request->file('images')Name = now()->format('YmdHis') . "_{$orientation}_" . $$request->file('images')->getClientOriginalName();

                // Store the $request->file('images') with the custom name
                $path = $request->file('image')->storeAs('sponsor_images', $imageName, 'public');
        }
        // dd($path);
        Sponsor::create([
            'conf_id'=>$request->conf_id,
            'image' => $path,
            'link' => $request->link,
            // Add more image properties as needed
        ]);

        return back()->with(['success'=>"Sponsor created successfully"]);

    }

    public function deleteSponsor($id){
        Sponsor::find($id)->delete();
        return back()->with(['success'=>"Sponsor deleted successfully"]);
    }
}
