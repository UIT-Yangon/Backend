<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use HTMLPurifier;
use HTMLPurifier_Config;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = 'faq_' . serialize($request->all());

        if (Cache::has($cacheKey)) {
            $faqs = Cache::get($cacheKey);
        } else {
            $sortBy = $request->query('sort_by', 'id');
            $sortDir = $request->query('sort_dir', 'asc');

            $faqs = Faq::orderBy($sortBy, $sortDir)->paginate(10);

            Cache::put($cacheKey, $faqs, 60);
        }

        return response()->json($faqs);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $purifierConfig = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($purifierConfig);

            $Question = $purifier->purify($request->question);
            $Answer = $purifier->purify($request->answer);

            $faq = new Faq();
            $faq->question = $Question;
            $faq->answer = $Answer;

            $faq->save();
            return response()->json(['message' => 'FAQ created successfully'], 201);
        }catch (QueryException $e) {
            return response()->json(['error' => 'Failed to create FAQ: ' . $e->getMessage()], 500);
        }
    }

    public function show(String $id)
    {
        $cacheKey = 'faq_' . $id;

        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }

        try{
            $faq = Faq::findOrFail($id);

            Cache::put($cacheKey, $faq, 60);
            return response()->json($faq);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'FAQ not found'], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $purifierConfig = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($purifierConfig);
            $faq = Faq::findOrFail($id);

            $faq->update([
                'question' => $purifier->purify($request->question),
                'answer' => $purifier->purify($request->answer),
            ]);
            
            $faq->save();
            return response()->json(['message' => 'FAQ updated successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'FAQ not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Fail to update staff: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(String $id)
    {
        try{
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return response()->json(['message' => 'FAQ deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'FAQ not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete FAQ: ' . $e->getMessage()], 500);
        }
    }
}
