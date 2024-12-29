<?php

namespace App\Models;

use App\Models\PDF;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pdfType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function pdfs()
    {
        return $this->hasMany(PDF::class, 'type_id'); // Assuming 'type_id' is the foreign key in the PDFs table
    }
}
