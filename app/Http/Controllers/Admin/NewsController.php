<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        
        $data = $query->paginate(10); // Adjust the number '10' to the number of items you want per page.
        
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
        
  // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            // 'user_id' => 'required|integer',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10000', // Example validation rules for images
        ])->validate();

        // Check if validation fails
        

        

            // Validation passed, proceed with creating the post
            // Create a new post
            $post = new Post();

            $post->title = $request->title;
            $post->body = $request->body;
            $post->type = $request->type;
            $post->user_id = '1';
            $post->save();
        

            // Process and save the images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Generate a unique name for the image
                    $imageName = time() . '_' . $image->getClientOriginalName();

                    // Store the image with the custom name
                $path = $image->storeAs('news_images', $imageName, 'public');

                    // Create a new Image record and associate it with the post
                    $post->images()->create([
                        'name' => $path,
                        'post_id' => $post->id,
                        // Add more image properties as needed
                    ]);
                }
            }
          
            return redirect()->route('news#list')->with('success', 'News created successfully');
    }
    public function delete($id)
    {
        $data = Post::find($id);
        $data->delete();
        return redirect()->route('news#list')->with('success', 'News deleted successfully');
    }
    
}

