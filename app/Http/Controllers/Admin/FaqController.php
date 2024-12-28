<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Faq;

use HTMLPurifier;
use HTMLPurifier_Config;

class FaqController extends Controller
{
    public function list()
    {
        $query = Faq::query();
        $faq = $query->orderBy('id', 'asc')->paginate(10);
        return view('faq.faq_list', compact('faq'));
    }

    public function create()
    {
        return view('faq.faq_create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ])->validate();

        $purifierConfig = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($purifierConfig);

        $Question = $purifier->purify($request->question);
        $Answer = $purifier->purify($request->answer);

        $faq = new Faq();
        $faq->question = $Question;
        $faq->answer = $Answer;

        $faq->save();
        return redirect()->route('faq#list')->with('success', 'Faq added successfully!');
    }

    public function detail($id)
    {
        $faq = Faq::find($id);
        return view('faq.faq_detail', compact('faq'));
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('faq.faq_edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ])->validate();

        $purifierConfig = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($purifierConfig);
        
        $faq = Faq::findOrFail($id);
        $faq->update([
            'question' => $purifier->purify($request->question),
            'answer' => $purifier->purify($request->answer),
        ]);
        return redirect()->route('faq#list')->with('success','Faq updated successfully!');
    }

    public function delete($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return redirect()->route('faq#list')->with('error', 'Faq not found!');
        }

        $faq->delete();
        return redirect()->route('faq#list')->with('success', 'Faq deleted successfully!');
    }
}
