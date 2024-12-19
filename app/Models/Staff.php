<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\Publication;
use App\Models\ResearchInterest;
use App\Models\StaffPublication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;
    protected $fillable=['image','name','position','biography','education','email','department','research_interests','courses_taught'];

    public function staff_publications()
    {
        return $this->hasMany(StaffPublication::class);
    }


}
