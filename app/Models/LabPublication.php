<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPublication extends Model
{
    use HasFactory;
    protected $fillable = ['title','date','link','lab'];
}
