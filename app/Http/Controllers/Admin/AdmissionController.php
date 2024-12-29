<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionReqirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdmissionController extends Controller
{
    public function createPage(){
        $requirements = AdmissionReqirement::first();
        // dd($requirements->toArray());
        return view('admission.create_admission',compact('requirements'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'student_intake' => 'required|integer',
            'requirements' => 'required|string',
           
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        AdmissionReqirement::create([
            'student_intake' => $request->student_intake,
            'requirements' => $request->requirements,
        ]);

        return redirect()->back()->with(['success'=>'Admission requirements created successfully']);


    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'student_intake' => 'required|integer',
            'requirements' => 'required|string',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // dd($request->toArray());
        AdmissionReqirement::where('id',$request->id)->update([
            'student_intake' => $request->student_intake,
            'requirements' => $request->requirements,
        ]);

        return redirect()->back()->with(['success'=>'Admission requirements updated successfully']);


    }

    // api
    public function showAdmissionRequirements(){
        $requirements = AdmissionReqirement::all();
        return response()->json($requirements, 200);
    }
}
