<?php

namespace App\Http\Controllers;

use App\Models\pdfType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{
    public function getPdfsGroupedByType()
    {
        // Get all pdf types with their related pdfs
        $pdfTypes = pdfType::with('pdfs')->get();

        // Format the data as key-value (PdfType name as key and PDFs as value)
        $pdfsGroupedByType = $pdfTypes->mapWithKeys(function ($pdfType) {
            return [
                $pdfType->name => $pdfType->pdfs->map(function ($pdf) {
                    return [
                        'id' => $pdf->id,
                        'title' => $pdf->title,
                        'path' => $pdf->path,
                        'created_at' => $pdf->created_at->toDateTimeString(),
                    ];
                })
            ];
        });

        // Return the response
        return response()->json($pdfsGroupedByType);
    }
}
