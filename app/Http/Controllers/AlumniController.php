<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use HTMLPurifier;
use HTMLPurifier_Config;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumni = Alumni::all();
        return response()->json($alumni, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $name = $purifier->purify($request->input('name'));
        $text = $purifier->purify($request->input('text'));

        $image1 = $request->file('image1')->store('images');
        $image2 = $request->file('image2')->store('images');

        $alumni = Alumni::create([
            'name' => $name,
            'text' => $text,
            'image1' => $image1,
            'image2' => $image2,
        ]);

        return response()->json(['message' => 'Data saved successfully', 'data' => $alumni], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        return response()->json($alumni, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $alumni = Alumni::findOrFail($id);

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $name = $purifier->purify($request->input('name'));
        $text = $purifier->purify($request->input('text'));

        $data = [
            'name' => $name,
            'text' => $text,
        ];

        if ($request->hasFile('image1')) {
            if ($alumni->image1 && Storage::exists($alumni->image1)) {
                Storage::delete($alumni->image1);
            }
            $data['image1'] = $request->file('image1')->store('images');
        }

        if ($request->hasFile('image2')) {
            if ($alumni->image2 && Storage::exists($alumni->image2)) {
                Storage::delete($alumni->image2);
            }
            $data['image2'] = $request->file('image2')->store('images');
        }

        $alumni->update($data);

        return response()->json(['message' => 'Data updated successfully', 'data' => $alumni], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alumni = Alumni::findOrFail($id);

        if ($alumni->image1 && Storage::exists($alumni->image1)) {
            Storage::delete($alumni->image1);
        }
        if ($alumni->image2 && Storage::exists($alumni->image2)) {
            Storage::delete($alumni->image2);
        }

        $alumni->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
}
