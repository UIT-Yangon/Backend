<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndustryCollaboration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use HTMLPurifier;
use HTMLPurifier_Config;

class IndustryCollaborationController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = 'ind_' . serialize($request->all());

        if (Cache::has($cacheKey)) {
            $industries = Cache::get($cacheKey);
        } else {
            $sortBy = $request->query('sort_by', 'id');
            $sortDir = $request->query('sort_dir', 'asc');

            $industries = IndustryCollaboration::orderBy($sortBy, $sortDir)->paginate(10);
            Cache::put($cacheKey, $industries, 60);
        }

        return response()->json($industries);
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

            $industry = IndustryCollaboration::create([
                'name' => $purifier->purify($request->name),
                'country' => $purifier->purify($request->country),
                'link' => $purifier->purify($request->link),
            ]);

            return response()->json(['message' => 'Industry Collaboration created successfully', 'data' => $industry], 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to create Industry Collaboration: ' . $e->getMessage()], 500);
        }
    }

    public function show(String $id)
    {
        $cacheKey = 'ind_' . $id;

        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }

        try {
            $industry = IndustryCollaboration::findOrFail($id);

            Cache::put($cacheKey, $industry, 60);
            return response()->json($industry);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Industry Collaboration not found'], 404);
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

            $industry = IndustryCollaboration::findOrFail($id);
            $industry->update([
                'name' => $purifier->purify($request->name),
                'country' => $purifier->purify($request->country),
                'link' => $purifier->purify($request->link),
            ]);

            return response()->json(['message' => 'Industry Collaboration updated successfully', 'data' => $industry], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Industry Collaboration not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to update Industry Collaboration: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(String $id)
    {
        try {
            $industry = IndustryCollaboration::findOrFail($id);
            $industry->delete();

            return response()->json(['message' => 'Industry Collaboration deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Industry Collaboration not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete Industry Collaboration: ' . $e->getMessage()], 500);
        }
    }
}
