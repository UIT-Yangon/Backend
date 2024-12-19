<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\Publication;
use App\Models\ResearchInterest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable=['image','name','position','biography','education','email','department','research_interests','courses_taught'];

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

}
