<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_News_Images extends Model
{
    use HasFactory;
    public function sub_news()
    {
        $this->belongsTo(Sub_News::class);
    }
}
