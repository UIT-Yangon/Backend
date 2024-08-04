<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\ResearchInterest;
use App\Models\Staff;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use HTMLPurifier;
use HTMLPurifier_Config;

class StaffController extends Controller
{
    public function list(Request $request)
    {
        $query = Staff::query();
        $data = $query->orderBy('created_at', 'asc')->paginate(10); 
        return view('staff.staff_list', ['data' => $data]);
    }

    public function create()
    {
        return view('staff.staff_create');
    }

    public function detail($id)
    {
        $data = Staff::find($id);
        return view('staff.staff_detail' , ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
            'name' => 'required|string',
            'position' => 'required|string',
            'biography' => 'required|string',
            'education' => 'required|string',
        ])->validate();

            $purifierConfig = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($purifierConfig);

            $staffName = $purifier->purify($request->name);
            $position = $purifier->purify($request->position);
            $biography = $purifier->purify($request->biography);
            $education = $purifier->purify($request->education);

            $staff = new Staff();
            $staff->name = $staffName;
            $staff->position = $position;
            $staff->biography = $biography;
            $staff->education = $education;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public/images', $imageName); // Store in 'public/images' folder
                $staff->image = 'images/' . $imageName; // Store the path in the image column
            }

            $staff->save();

            return redirect()->route('staff#list')->with('success', 'Staff added successfully');
        
    }

    public function edit($id){
        $data = Staff::find($id);
       return view('staff.staff_edit',compact('data'));
   }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
            'name' => 'required|string',
            'position' => 'required|string',
            'biography' => 'required|string',
            'education' => 'required|string',
        ])->validate();

        

            $purifierConfig = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($purifierConfig);
            $staff = Staff::findOrFail($id);

        //     $images = $staff->images ?? [];
        //     if ($request->hasFile('image')) {
        //     foreach ($request->file('image') as $file) {
        //         $path = $file->store('image', 'public');
        //         $images[] = $path;
        //     }
        // }


            // Update fields
            $staff->update([
                'name' => $purifier->purify($request->name),
                'position' => $purifier->purify($request->position),
                'biography' => $purifier->purify($request->biography),
                'education' => $purifier->purify($request->education)
            ]);

            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($staff->image) {
                    Storage::delete($staff->image);
                }

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $path = $image->storeAs('public/images', $imageName); // Store in 'public/images' folder
                    $staff->image = 'images/' . $imageName; // Store the path in the image column
                }
            }

            $staff->save();

            
            return redirect()->route('staff#list')->with('success', 'Staff updated successfully.');

        
    }

    // public function deleteImage($id)
    // {
    //     $staff = Staff::findOrFail($id);

    //     if ($staff->image) {
    //     // Delete the image file from storage
    //     Storage::delete($staff->image);

    //     // Remove the image path from the database
    //     $staff->image = null;
    //     $staff->save();
    //     }
    // }

    public function delete($id)
    {
        $staff = Staff::findOrFail($id);
        if ($staff->image) {
            Storage::delete($staff->image);
        }
        $staff->delete();
        return redirect()->route('staff#list')->with('success', 'Staff deleted successfully');
    }

}
