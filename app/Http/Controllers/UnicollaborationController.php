<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UniCollaboration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use HTMLPurifier;
use HTMLPurifier_Config;

class UniCollaborationController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = 'uni_' . serialize($request->all());

        if (Cache::has($cacheKey)) {
            $universities = Cache::get($cacheKey);
        } else {
            $sortBy = $request->query('sort_by', 'id');
            $sortDir = $request->query('sort_dir', 'asc');

            $universities = UniCollaboration::orderBy($sortBy, $sortDir)->paginate(10);
            Cache::put($cacheKey, $universities, 60);
        }

        return response()->json($universities);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $purifierConfig = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($purifierConfig);

            $university = UniCollaboration::create([
                'name' => $purifier->purify($request->name),
                'country' => $purifier->purify($request->country),
                'link' => $purifier->purify($request->link),
            ]);

            return response()->json(['message' => 'University Collaboration created successfully', 'data' => $university], 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to create University Collaboration: ' . $e->getMessage()], 500);
        }
    }


    public function show(String $id)
    {
        $cacheKey = 'uni_' . $id;

        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }

        try {
            $university = UniCollaboration::findOrFail($id);

            Cache::put($cacheKey, $university, 60);
            return response()->json($university);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'University Collaboration not found'], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $purifierConfig = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($purifierConfig);

            $university = UniCollaboration::findOrFail($id);
            $university->update([
                'name' => $purifier->purify($request->name),
                'country' => $purifier->purify($request->country),
                'link' => $purifier->purify($request->link),
            ]);

            return response()->json(['message' => 'University Collaboration updated successfully', 'data' => $university], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'University Collaboration not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to update University Collaboration: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(String $id)
    {
        try {
            $university = UniCollaboration::findOrFail($id);
            $university->delete();

            return response()->json(['message' => 'University Collaboration deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'University Collaboration not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete University Collaboration: ' . $e->getMessage()], 500);
        }
    }
}
