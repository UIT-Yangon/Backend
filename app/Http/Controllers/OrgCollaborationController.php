<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrgCollaboration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use HTMLPurifier;
use HTMLPurifier_Config;

class OrgCollaborationController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = 'org_' . serialize($request->all());

        if (Cache::has($cacheKey)) {
            $organizations = Cache::get($cacheKey);
        } else {
            $sortBy = $request->query('sort_by', 'id');
            $sortDir = $request->query('sort_dir', 'asc');

            $organizations = OrgCollaboration::orderBy($sortBy, $sortDir)->paginate(10);
            Cache::put($cacheKey, $organizations, 60);
        }

        return response()->json($organizations);
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

            $organization = OrgCollaboration::create([
                'name' => $purifier->purify($request->name),
                'country' => $purifier->purify($request->country),
                'link' => $purifier->purify($request->link),
            ]);

            return response()->json(['message' => 'Organization Collaboration created successfully', 'data' => $organization], 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to create Organization Collaboration: ' . $e->getMessage()], 500);
        }
    }

    public function show(String $id)
    {
        $cacheKey = 'org_' . $id;

        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }

        try {
            $organization = OrgCollaboration::findOrFail($id);

            Cache::put($cacheKey, $organization, 60);
            return response()->json($organization);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Organization Collaboration not found'], 404);
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

            $organization = OrgCollaboration::findOrFail($id);
            $organization->update([
                'name' => $purifier->purify($request->name),
                'country' => $purifier->purify($request->country),
                'link' => $purifier->purify($request->link),
            ]);

            return response()->json(['message' => 'Organization Collaboration updated successfully', 'data' => $organization], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Organization Collaboration not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to update Organization Collaboration: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(String $id)
    {
        try {
            $organization = OrgCollaboration::findOrFail($id);
            $organization->delete();

            return response()->json(['message' => 'Organization Collaboration deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Organization Collaboration not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete Organization Collaboration: ' . $e->getMessage()], 500);
        }
    }
}
