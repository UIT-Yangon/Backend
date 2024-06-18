<?php

namespace App\Livewire;

use App\Models\Sub_News;
use Livewire\Component;

class SubNews extends Component
{
    public $title;
    public $image;
    public $sub_body;
    public function save() 
    {
        $sanitizedHtml = strip_tags($this->sub_body, '<b><p><a><br><strong><em>'); // Allow only certain HTML tags

        $post = Sub_News::create([
            'sub_title' => $this->title,
            'image' => $this->image,
            'sub_body' => $this->sub_body,
            'post_id' => 0,
        ]);
 
       
    }
    public function delete($id)
    {
        Sub_News::find($id)->delete();
    }
    
    public function render()
    {
        return view('livewire.sub-news')->with('subNews',Sub_News::where('post_id','0')->get());
    }
}
