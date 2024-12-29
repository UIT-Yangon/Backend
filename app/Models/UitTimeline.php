<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UitTimeline extends Model
{
    use HasFactory;
    protected $fillable = ['id','date','title'];
}
