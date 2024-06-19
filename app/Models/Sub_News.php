<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_News extends Model
{
    use HasFactory;
    protected $fillable = [
       'sub_title','sub_body', 'post_id'
    ];
    public function post()
    {
        $this->belongsTo(Post::class);
    }
    public function sub_news_images()
    {
        $this->hasMany(Sub_News_Images::class);
    }
}
