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
    public function list()
    {
        $conferences = Conference::paginate(1);
        // dd($conferences[0]->toArray(),$conferences[0]->committe_members->toArray(),$conferences[0]->conference_image->toArray());
        return view('conference.list', compact('conferences'));
    }

    public function createPage()
    {
        return view('conference.create');
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'paperCall' => 'required',
            'status' => 'required',
            'email' => 'required',
            'local_fee' => 'required',
            'foreign_fee' => 'required',
            'paper_format' => 'required',
        ]);
        $bookPath = "";
        $brochurePath = "";
        $paperFormatPath = "";
        if ($request->hasFile('book')) {
            $bookFile = $request->file('book');
            $bookPath = now()->format('YmdHis') . '_book_' . $bookFile->getClientOriginalName();
            $bookFile->storeAs('conference_files', $bookPath, 'public');
        }
        if($request->hasFile('brochure')) {
            $brochureFile = $request->file('brochure');
            $brochurePath = now()->format('YmdHis') . '_brochure_' . $brochureFile->getClientOriginalName();
            $brochureFile->storeAs('conference_files', $brochurePath, 'public');
        }
        if($request->hasFile('paper_format')) {
           $paperFormatFile = $request->file('paper_format');
            $paperFormatPath = now()->format('YmdHis') . '_paper_format_' . $paperFormatFile->getClientOriginalName();
            $paperFormatFile->storeAs('conference_files', $paperFormatPath, 'public');
        }
        $conference = new Conference();
        $conference->name = $request->name;
        $conference->paperCall = $request->paperCall;
        $conference->original_deadline = $request->original_deadline;
        $conference->status = $request->status;
        $conference->accept_noti = $request->accept_noti;
        $conference->email = $request->email;
        $conference->book = $bookPath;
        $conference->brochure = $brochurePath;
        $conference->local_fee = $request->local_fee;
        $conference->foreign_fee = $request->foreign_fee;
        $conference->conference_date = $request->conference_date;
        $conference->paper_format = $paperFormatPath;
        $conference->camera_ready = $request->camera_ready;
        $conference->save();
        return back()->with('success', 'Conference created successfully.');

    }

    public function detail($id)
    {
        $keynote = [];
        $invited = [];
        $conference = Conference::where('id', $id)->get();
        $members = $conference[0]->committe_members;
        $images = explode(',', $conference[0]->images);
        $chair = [
            "general_chair" => $conference[0]->committe_members->where('chair_type', 'general chair')->first(),
            "general_co_chair" => $conference[0]->committe_members->where('chair_type', 'general co-chair')->first(),
            "program_chair" => $conference[0]->committe_members->where('chair_type', 'program chair')->first(),
        ];
        foreach ($members as $member) {
            if ($member->speaker_type == 'keynote') {
                array_push($keynote, $member);
            } else if ($member->speaker_type == 'invited') {
                array_push($invited, $member);
            }
        }
        // dd($images);
        return view('conference.detail', compact('conference', 'members', 'images', 'chair', 'keynote', 'invited'));
    }

    public function delete($id)
    {
        CommitteMember::where('conference_id', $id)->delete();
        // ConferenceImage::where('conference_id',$id)->delete();
        Conference::where('id', $id)->delete();

        return redirect()->route('conf#list')->with('success', 'Conference deleted successfully');
    }

    public function commitee(Request $request, $id, $type)
    {

        $type1 = $type;
        $query = CommitteMember::query();
        // dd($id);
        if ($request->input('search') != null) {
            $search = $request->input('search');

            $query->where('conference_id', $id)->where('member_type', $type1)->where('name', 'like', '%' . $search . '%')->orWhere('university', 'like', '%' . $search . '%');
        }
        $members = $query->where('conference_id', $id)->where('member_type', $type1)->orderBy('rank', 'desc')->get();
        //  dd($members->toArray());

        return view('conference.commitee_members', compact('members', 'id', 'type'));
    }
    public function deleteMember($id)
    {
        $member = CommitteMember::where('id', $id)->first();
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }
        CommitteMember::where('id', $id)->delete();
        return back()->with(['success' => 'Committee member deleted successfully', 'member' => $member]);
    }

    public function editMemberPage($id)
    {
        $member = CommitteMember::where('id', $id)->first();
        return view('conference.edit_member', compact('id', 'member'));
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

    public function addMemberPage($id)
    {
        $confName = Conference::where('id', $id)->first()->name;
        return view('conference.add_member', compact('id', 'confName'));
    }

    public function addMember(Request $request, $id)
    {
        // dd($id);
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'rank' => 'nullable|string|max:255',
            'university' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'nation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);
        if ($request->hasFile('image')) {
            // Store the new image and get its path
            $imagePath = $request->file('image')->store('conference_images', 'public');
            $imageName = basename($imagePath);
        }

        // Create a new member
        $member = new CommitteMember();
        $member->name = $validatedData['name'];
        $member->rank = $validatedData['rank'];
        $member->university = $validatedData['university'];
        $member->position = $validatedData['position'];
        $member->nation = $validatedData['nation'];
        $member->member_type = $request->input('member_type');
        $member->chair_type = $request->input('chair_type');
        $member->speaker_type = $request->input('speaker_type');
        $member->conference_id = $id;
        if ($request->hasFile('image')) {
            $member->image = $imageName;
        }
        $member->save();

        return back()->with(['success' => 'Committee member added successfully']);
    }


    // edit info of conf
    public function editPage($id){
        $conference = Conference::where('id', $id)->get();
        // dd($conference->toArray());
        return view('conference.edit_conf_info',compact('conference'));
    }

    public function updateInfo(Request $request){
        dd($request);
    }
}

