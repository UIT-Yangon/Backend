<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LabPublication;
use Illuminate\Http\Request;

class LabPublicationController extends Controller
{
    public function index(){
        $publications = LabPublication::get();
        return response()->json($publications);
    }

    public function filterByLab($lab){
        $publications = LabPublication::where('lab',$lab)->get();
        return response()->json($publications);
    }
}
