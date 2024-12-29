<?php

namespace App\Http\Controllers;

use App\Models\UitTimeline;
use App\Models\VisionMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UitTimelineController extends Controller
{
    public function aboutPage(){
        $timelines = UitTimeline::all();
        $hvmv = VisionMission::all();
        return view('about.about',compact('timelines','hvmv'));
    }

    public function storeTimeline(Request $request){
        $validated = Validator::make($request->all(),[
            'date'=>'required',
            'title'=>'required|string',
        ])->validate();

        UitTimeline::create([
            'date'=>$request->date,
            'title'=>$request->title,
          
        ]);
        return back()->with('success','Timeline added successfully');
    }
}
