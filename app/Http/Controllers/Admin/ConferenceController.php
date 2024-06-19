<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommitteMember;
use App\Models\Conference;
use App\Models\ConferenceImage;
use Illuminate\Http\Request;

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
        $images = $conference[0]->conference_image;
        // dd($members,$images);
        return view('conference.detail',compact('conference','members','images'));
    }

    public function delete($id)
    {
        CommitteMember::where('conference_id',$id)->delete();
        // ConferenceImage::where('conference_id',$id)->delete();
        Conference::where('id',$id)->delete();

        return redirect()->route('conf#list')->with('success', 'Conference deleted successfully');
    }
}
