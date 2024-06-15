<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function list(){
        return view('news.news_list');
    }

    public function detailPage($id){
        return view('news.news_detail');
    }

    public function editPage($id){
        return view('news.news_edit');
    }
}
