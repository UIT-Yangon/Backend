<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Sub_News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{


    public function index(Request $request, $type)
    {
        $posts = '';
        // Define a cache key based on the request parameters

        // Check if the data is already cached
       
        
            // If not cached, fetch the posts from the database
            $sortBy = $request->query('sort_by', 'created_at');
            $sortDir = $request->query('sort_dir', 'desc');
            $adminId = $request->query('admin_id');
            $startDate = $request->query('start_date');
            $endDate = $request->query('end_date');
            $searchQuery = $request->query('search');

            $query = Post::with('images')->orderBy($sortBy, $sortDir);

            if ($adminId) {
                $query->where('admin_id', $adminId);
            }
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
            if ($searchQuery) {
                $query->where(function ($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                        ->orWhere('body', 'like', '%' . $searchQuery . '%');
                });
            }
            if($type === 'activities')
            {
                $posts = $query->where('type','activities')
                                ->orWhere('type','activities/calender')
                                ->get();
            }
            else if($type === 'calender')
            {
                $posts = $query->where('type','activities/calender')
                                ->get();
            }
            else
            {
                $posts = $query->where('type',$type)->get();
            }


        

        // Modify the posts to include only the first landscape image
        $modifiedPosts = $posts->map(function ($post) {
            $firstLandscapeImage = $post->images->firstWhere('type', 'landscape');
            return [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'type' => $post->type,
                'date' => $post->date ? $post->date : null,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'image' => $firstLandscapeImage ? $firstLandscapeImage->name : null,
            ];
        });

        // Return the modified response
        return response()->json($modifiedPosts);
    }


    // public function store(Request $request)
    // {
    //     // Validate the incoming request data
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|string',
    //         'body' => 'required|string',
    //         'user_id' => 'required|integer',
    //         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10000', // Example validation rules for images
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         // Return a JSON response with validation errors and status code 422
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     try {

    //         // Validation passed, proceed with creating the post
    //         // Create a new post
    //         $post = new Post();

    //         $post->title = $request->title;
    //         $post->body = $request->body;
    //         $post->user_id = $request->user_id;
    //         $post->save();

    //         // Process and save the images
    //         if ($request->hasFile('images')) {
    //             foreach ($request->file('images') as $image) {
    //                 // Generate a unique name for the image
    //                 $imageName = time() . '_' . $image->getClientOriginalName();

    //                 // Store the image with the custom name
    //                 $path = $image->storeAs('images', $imageName);

    //                 // Create a new Image record and associate it with the post
    //                 $post->images()->create([
    //                     'name' => $path,
    //                     // Add more image properties as needed
    //                 ]);
    //             }
    //         }

    //         // Return a JSON response with a success message and status code 201
    //         return response()->json(['message' => 'Post created successfully'], 201);
    //     } catch (QueryException $e) {
    //         // Return a JSON response with an error message if creating the post fails
    //         return response()->json(['error' => 'Failed to create post'], 500);
    //     }
    // }

    public function show($id)
    {
      
        $post = Post::with('images')->find($id);
        // dd($post->toArray());

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Separate images into landscape and portrait arrays and find the heading image
        $landscapeImages = [];
        $portraitImages = [];
        $headingImage = null;

        foreach ($post->images as $image) {
            $imageData = [
                'name' => $image->name,
                'type' => $image->type,
            ];
            if ($image->type == 'landscape') {
                $landscapeImages[] = $imageData['name'];
            } else if ($image->type == 'portrait') {
                $portraitImages[] = $imageData['name'];
            } else if ($image->type == 'heading') {
                $headingImage = $imageData['name'];
            }
        }

        // Manually construct the response data
        $response = [
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,
            'type' => $post->type,
            'user_id' => $post->user_id,
            'deleted_at' => $post->deleted_at,
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
            'images' => [
                'heading' => $headingImage,
                'landscape' => $landscapeImages,
                'portrait' => $portraitImages,
            ],
        ];

        // Cache the constructed response data for 60 minutes (adjust as needed)

        // Return the constructed response
        return response()->json($response);
    }

    public function cc($id)
    {
        
    }



}
