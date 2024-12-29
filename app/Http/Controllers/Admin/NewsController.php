<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsImage;
use App\Models\Sub_News;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function list(Request $request)
    {
        $query = Post::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%");
            }


        $data = $query->orderBy('created_at', 'asc')->paginate(10); // Adjust the number '10' to the number of items you want per page.
        // dd($query->toArray());
        return view('news.news_list', ['data' => $data]);
    }


    public function detail($id)
    {
        $data = Post::with('images')->find($id);
        return view('news.news_detail', ['data' => $data]);
    }
    public function create()
    {
        return view('news.news_create');
    }
    public function store(Request $request)
    {
        // dd($request->all());

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            // 'user_id' => 'required|integer',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
             // Example validation rules for images
        ])->validate();

        // Check if validation fails




        // Validation passed, proceed with creating the post
        // Create a new post
        $allowedTags = '<p><a><b><i><u><strong><em><br><ul><ol><li><h1><h2><h3><h4><h5><h6><blockquote><code><pre><img><table><thead><tbody><tr><th><td>';
        $sanitizedBody = strip_tags($request->body, $allowedTags);
        $post = new Post();

        $post->title = $request->title;
        $post->body = $sanitizedBody;
        $post->type = $request->type;
        $post->date = $request->date;
        $post->user_id = '1';
        $post->save();


        // Process and save the images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                list($width, $height) = getimagesize($image);
                // Determine the orientation
                $orientation = $width > $height ? 'landscape' : 'portrait';
                // Generate a unique name for the image
                $imageName = time() . '_' . $image->getClientOriginalName();
                // $imageName = now()->format('YmdHis') . "_{$orientation}_" . $image->getClientOriginalName();

                // Store the image with the custom name
                $path = $image->storeAs('news_images', $imageName, 'public');

                // Create a new Image record and associate it with the post
                $post->images()->create([
                    'name' => $path,
                    'post_id' => $post->id,
                    'type' => $orientation
                    // Add more image properties as needed
                ]);
            }
        }


        return redirect()->route('news#list')->with('success', 'News created successfully');
    }

    public function editPage($id){
         $data = Post::with('images')->find($id);
        // dd($images->toArray());
        // dd($data->toArray());
        return view('news.news_edit',compact('data'));
    }

    public function update(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
        ])->validate();


        $id = $request->id;
        $allowedTags = '<p><a><b><i><u><strong><em><br><ul><ol><li><h1><h2><h3><h4><h5><h6><blockquote><code><pre><img><table><thead><tbody><tr><th><td>';
        $sanitizedBody = strip_tags($request->body, $allowedTags);
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->body = $sanitizedBody;
        $post->date = $request->date;
        $post->type = $request->type;
        $post->save();

        $post = new Post();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                list($width, $height) = getimagesize($image);
                // Determine the orientation
                $orientation = $width > $height ? 'landscape' : 'portrait';
                // Generate a unique name for the image
                $imageName = time() . '_' . $image->getClientOriginalName();
                // $imageName = now()->format('YmdHis') . "_{$orientation}_" . $image->getClientOriginalName();

                // Store the image with the custom name
                $path = $image->storeAs('news_images', $imageName, 'public');

                // Create a new Image record and associate it with the post
                // dd($id);
                NewsImage::create([
                    'name' => $path,
                    'post_id' => $id,
                    'type' => $orientation
                    // Add more image properties as needed
                ]);
            }
        }

        return back()->with('success', 'News updated successfully');

    }


public function deleteImage($id){
    NewsImage::where('id',$id)->delete();
    return back()->with('success', 'News Image deleted successfully');
}

    public function delete($id)
    {
        $data = Post::find($id);
        $data->delete();
        return redirect()->route('news#list')->with('success', 'News deleted successfully');
    }
}
