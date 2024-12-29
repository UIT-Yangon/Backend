<?php

namespace App\Models;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffPublication extends Model
{
    use HasFactory;
    protected $fillable = ['staff_id','title','description','date'];

    public function staff(){
        $this->belongsTo(Staff::class,'staff_id');
    }

}