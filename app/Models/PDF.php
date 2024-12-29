<?php

namespace App\Models;

use App\Models\pdfType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PDF extends Model
{
    use HasFactory;
    protected $fillable = ['title','path','type_id'];
    public function pdfType()
    {
        return $this->belongsTo(pdfType::class, 'type_id'); // Assuming 'type_id' is the foreign key in the PDFs table
    }
}
