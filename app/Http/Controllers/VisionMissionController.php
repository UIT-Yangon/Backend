<?php

namespace App\Http\Controllers;

use App\Models\UitTimeline;
use App\Models\VisionMission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class VisionMissionController extends Controller
{
    public function storeVisionMission(Request $request){
        $validated = Validator::make($request->all(),[
            'history'=>'required',
            'vision'=>'required',
           'mission'=>'required',
            'value'=>'required'
        ])->validate();
        
        VisionMission::create([
            'history'=>$request->history,
            'vision'=>$request->vision,
           'mission'=>$request->mission,
           'value'=>$request->value

        ]);
        return back()->with(['historysuccess'=>"History , Vision, Mission and Values created successfully"]);
    }

    public function updateVisionMission(Request $request){
        $validated = Validator::make($request->all(),[
            'history'=>'required',
            'vision'=>'required',
           'mission'=>'required',
            'value'=>'required'
        ])->validate();
        
        VisionMission::where('id',$request->id)->update([
            'history'=>$request->history,
            'vision'=>$request->vision,
           'mission'=>$request->mission,
           'value'=>$request->value
        ]);
        return back()->with(['historysuccess'=>"History , Vision, Mission and Values are updated successfully"]);
    }


    public function showAboutVMV(){
        $visionMission = VisionMission::first();
        $timelines = UitTimeline::all();
        return response()->json([
            'visionMission'=>$visionMission,
            'timelines'=>$timelines,
        ]);
    }
}
