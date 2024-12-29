<?php

namespace App\Http\Controllers\Admin;

use App\Models\PDF;
use App\Models\pdfType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    /*************  ✨ Codeium Command ⭐  *************/
    /******  6bbecaea-6dd7-47a4-9dbf-8bdfe12bfdd9  *******/
    public function list1()
    {

        $data = pdfType::with('pdfs')->get();
        // dd(vars: $data->toArray());

        // dd(vars: $data[0]->toArray());
        return view('pdf.pdf_list', ['data' => $data]);
    }

    public function create($id)
    {
        $data = pdfType::find($id);
        // dd($data->toArray());
        return view('pdf.pdf_link_create', compact('data'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'path' => 'mimes:pdf|max:2048', // Ensures the file is a PDF and less than 2MB
            'title' => 'required|string|max:255',    // Validates the title
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

            PDF::create([
                'title' => $request->input('title'),
                'path' => $filePath,
                'type_id' => $request->input('type_id'),
            ]);



            return redirect()->route('pdf#list')->with('success', 'PDF uploaded successfully!');
        }
    }
    public function viewPDF($id)
    {
        // Fetch the record from the database
        $pdfRecord = PDF::find($id); // Replace with your actual model or query
        if (!$pdfRecord) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Path stored in the database
        $filePath = storage_path("app/public/{$pdfRecord->path}"); // Assuming 'path' is the database column
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found on server'], 404);
        }

        // Return the PDF for inline viewing
        return response()->file($filePath);
    }
    public function delete($id)
{
    // Fetch the PDF record from the database
    $pdfRecord = PDF::find($id);

    // Check if the record exists
    if (!$pdfRecord) {
        return redirect()->route('pdf#list')->with('error', 'PDF not found!');
    }

    // Define the file path in the storage directory
    $filePath = public_path("storage/uploads/{$pdfRecord->path}");

    // Check if the file exists before attempting to delete
    if (file_exists($filePath)) {
        // Delete the file from the storage folder
        unlink($filePath);
    }

    // Delete the record from the database
    $pdfRecord->delete();

    // Redirect with success message
    return redirect()->route('pdf#list')->with('success', 'PDF deleted successfully!');
}

    
}
