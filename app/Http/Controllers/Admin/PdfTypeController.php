<?php

namespace App\Http\Controllers\Admin;

use App\Models\PDF;
use App\Models\pdfType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PdfTypeController extends Controller
{
    public function create(){
        return view('pdf.pdf_create');
    }

    public function store(Request $request)
    {
    // Validate the input
    $validator = Validator::make($request->all(), [
        'path' => 'mimes:pdf|max:2048', // Ensures the file is a PDF and less than 2MB
        'title' => 'required|string|max:255', 
        'name' => 'required|string|max:255',   // Validates the title
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Handle the file upload
    if ($request->hasFile('path') && $request->file('path')->isValid()) {
        $file = $request->file('path');
        $filePath = $file->store('uploads', 'public'); // Save file in 'storage/app/public/uploads'

        // Save to database if needed
        // Example:
        // Document::create([
        //     'title' => $request->input('title'),
        //     'file_path' => $filePath,
        // ]);

        $id = pdfType::create([
            'name' => $request->input('name'),
        ]);
        // dd(vars$id->id);
        PDF::create([
            'title' => $request->input('title'),
            'path' => $filePath,
            'type_id' => $id->id
        ]);

        

        return redirect()->route('pdf#list')->with('success', 'PDF uploaded successfully!');

        
    }
    

    pdfType::create([
        'name' => $request->input('title'),
    ]);

    return redirect()->route('pdf#list')->with('success', 'PDF uploaded successfully!');

}

    public function delete($id){
        pdfType::where('id', $id)->delete();
        PDF::where('type_id', $id)->delete();
        return redirect()->route('pdf#list')->with('success', 'PDF deleted successfully!');
    }
}
