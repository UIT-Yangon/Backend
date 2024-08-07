<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsImage extends Model
{
    use HasFactory;
    protected $fillable=['name','type','post_id'];
    public function post()
    {
        $this->belongsTo(Post::class);
    }
}
