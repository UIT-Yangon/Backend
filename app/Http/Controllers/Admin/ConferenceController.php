<?php

namespace App\Http\Controllers\Admin;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Models\CommitteMember;
use App\Models\ConferenceImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ConferenceController extends Controller
{
    public function list(){
        $conferences = Conference::paginate(1);
        // dd($conferences[0]->toArray(),$conferences[0]->committe_members->toArray(),$conferences[0]->conference_image->toArray());
        return view('conference.list',compact('conferences'));
    }

    public function detail($id){
        $conference = Conference::where('id',$id)->get();
        $members = $conference[0]->committe_members;
        $images = explode(',', $conference[0]->images);
        $chair = [
            "general_chair" => $conference[0]->committe_members->where('chair_type','general chair')->first(),
            "general_co_chair" => $conference[0]->committe_members->where('chair_type','general co-chair')->first(),
            "program_chair" => $conference[0]->committe_members->where('chair_type','program chair')->first(),
        ];
        // dd($images);
        return view('conference.detail',compact('conference','members','images','chair'));
    }

    public function delete($id)
    {
        CommitteMember::where('conference_id',$id)->delete();
        // ConferenceImage::where('conference_id',$id)->delete();
        Conference::where('id',$id)->delete();

        return redirect()->route('conf#list')->with('success', 'Conference deleted successfully');
    }

    public function commitee(Request $request, $id,$type)
    {
        $type1 = $type;
        $query = CommitteMember::query();
        // dd($id);
        if($request->input('search') != null){
            $search = $request->input('search');
            
            $query->where('conference_id', $id)->where('member_type', $type1)->where('name','like','%'.$search.'%')->orWhere('university','like','%'.$search.'%');
         }
         $members = $query->where('conference_id', $id)->where('member_type', $type1)->orderBy('rank','desc')->get(); 
        //  dd($members->toArray());
  
        return view('conference.commitee_members',compact('members','id','type'));
        
    }
    public function deleteMember($id)
    {
        $member = CommitteMember::where('id',$id)->first();
        CommitteMember::where('id',$id)->delete();
        return back()->with(['success'=> 'Committee member deleted successfully', 'member' => $member]);
    }

    public function editMemberPage($id)
    {
        $member = CommitteMember::where('id',$id)->first();
        return view('conference.edit_member',compact('id','member'));
    }

    public function editMember(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'rank' => 'nullable|string|max:255',
        'university' => 'required|string|max:255',
        'position' => 'nullable|string|max:255',
        'nation' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
    ]);

    // Find the member by ID
    $member = CommitteMember::find($id);

    // Check if the member exists
    if (!$member) {
        return response()->json(['error' => 'Member not found'], 404);
    }

    // Handle image upload if present
    if ($request->hasFile('image')) {
        // Store the new image and get its path
        $imagePath = $request->file('image')->store('conference_images', 'public');
        $imageName = basename($imagePath);


        // Optionally, delete the old image if it exists
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }

        // Update the member's image path
        $member->image = $imageName;
    }

    // Update the member's details
    $member->name = $validatedData['name'];
    $member->rank = $validatedData['rank'];
    $member->university = $validatedData['university'];
    $member->position = $validatedData['position'];
    $member->nation = $validatedData['nation'];
    $member->save();

    // Return a success response
    return back()->with(['success' => 'Committee member updated successfully']);
}

}
