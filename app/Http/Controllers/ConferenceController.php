<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Committee;
use App\Models\Conference;
use Illuminate\Http\Request;
use App\Models\CommitteMember;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ConferenceController extends Controller
{

    //conf title list
    public function index(Request $request)
    {
        // Define a cache key based on the request parameters
        $cacheKey = 'confs_' . serialize($request->all());

        // Check if the data is already cached
        if (Cache::has($cacheKey)) {
            // If cached, retrieve and return the cached data
            $conf = Cache::get($cacheKey);
        } else {
            // If not cached, fetch the posts from the database
            $sortBy = $request->query('sort_by', 'created_at');
            $sortDir = $request->query('sort_dir', 'desc');
            $perPage = $request->query('per_page', 10); // Default per page is 10

            $query = Conference::select("id", "name")->orderBy($sortBy, $sortDir);
            $conf = $query->get();

            // Cache the fetched posts for 60 minutes (adjust as needed)
            Cache::put($cacheKey, $conf, 60); // Cache for 60 minutes
        }

        // Return the response
        return response()->json($conf);
    }

    // conf detail
    public function show($id)
    {
        $cacheKey = 'conference_' . $id;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Use eager loading to load the members relationship
        $conference = Conference::with('committe_members')->find($id);

        if ($conference) {
            // Split the images string into an array
            $imageNames = explode(',', $conference->images);

            // Initialize arrays for landscape and portrait images
            $landscapeImages = [];
            $portraitImages = [];
            $headingImages = [];

            // Categorize images into landscape and portrait arrays
            foreach ($imageNames as $imageName) {
                if (strpos($imageName, 'landscape') !== false) {
                    $landscapeImages[] = $imageName;
                } elseif (strpos($imageName, 'portrait') !== false) {
                    $portraitImages[] = $imageName;
                }
                elseif (strpos($imageName, 'heading') !== false) {
                    $headingImages[] = $imageName;
                }
            }

            // Initialize arrays for different roles
            $invitedSpeakers = [];
            $keynoteSpeakers = [];
            $programCommitteeLocal = [];
            $programCommitteeForeign = [];
            $organizingCommittee = [];
            $generalChair = [];
            $generalCoChair = [];
            $programChair = [];

            foreach ($conference->committe_members as $member) {
                // Assume each member has an image with a name convention or a field `image_name`
                $memberImage = $member->image_name ?? 'default.jpg'; // Replace 'default.jpg' with your default image

                // Format the member's details
                if($member->rank && $member->position){
                $formattedMember = [
                    $memberImage,
                    "{$member->rank}.{$member->name}, {$member->position}, {$member->university} {$member->nation}"
                ];
                }
                else if($member->rank){
                $formattedMember = [
                    $memberImage,
                    "{$member->rank} {$member->name},  {$member->university} {$member->nation}"
                ];
                }
                else if($member->position){
                    $formattedMember = [
                        $memberImage,
                        "{$member->name}, {$member->position}, {$member->university} {$member->nation}"
                    ];
                }
                else{
                    $formattedMember = [
                        $memberImage,
                        "{$member->name}, {$member->university} {$member->nation}"
                        ];
                    }

                // Categorize the member based on their types
                switch ($member->speaker_type) {
                    case 'invited':
                        $invitedSpeakers[] = $formattedMember;
                        break;
                    case 'keynote':
                        $keynoteSpeakers[] = $formattedMember;
                        break;
                }
                switch ($member->member_type) {
                    case 'program':
                        if ($member->nation == 'Myanmar' || $member->nation == 'myanmar') {
                            $programCommitteeLocal[] = $formattedMember;
                        } else {
                            $programCommitteeForeign[] = $formattedMember;
                        }
                        break;
                    case 'organizing':
                        $organizingCommittee[] = $formattedMember;
                        break;
                }
                switch ($member->chair_type) {
                    case 'general chair':
                        $generalChair[] = $formattedMember;
                        break;
                    case 'general co-chair':
                        $generalCoChair[] = $formattedMember;
                        break;
                    case 'program chair':
                        $programChair[] = $formattedMember;
                        break;
                }
            }

            // Prepare the response data without committe_members array
            $conferenceData = $conference->toArray();
            unset($conferenceData['committe_members']);
            $conferenceData['images'] = [
                'landscape' => $landscapeImages,
                'portrait' => $portraitImages,
                'heading'=>$headingImages,
            ];
            $conferenceData['invited_speakers'] = $invitedSpeakers;
            $conferenceData['keynote_speakers'] = $keynoteSpeakers;
            $conferenceData['program_committee'] = [
                'local' => $programCommitteeLocal,
                'foreign' => $programCommitteeForeign
            ];
            $conferenceData['organizing_committee'] = $organizingCommittee;
            $conferenceData['general_chair'] = $generalChair;
            $conferenceData['general_co_chair'] = $generalCoChair;
            $conferenceData['program_chair'] = $programChair;

            // Cache the conference data
            Cache::put($cacheKey, $conferenceData, 60);

            // Return the response with the conference data
            return response()->json($conferenceData);
        } else {
            return response()->json(["message" => "Conference not found"], 404);
        }
    }







    /////////create
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'string',
    //         'paperCall' => 'string',
    //         'updated_deadline' => 'nullable|date',
    //         'original_deadline' => 'nullable|date',
    //         'status' => 'string',
    //         'accept_noti' => 'nullable|date',
    //         'email' => 'email',
    //         'local_fee' => 'integer',
    //         'foreign_fee' => 'integer',
    //         'conference_date' => 'date',
    //         'topics.*' => 'string',  // Ensure each topic is a string
    //         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Allow multiple image uploads
    //         'book' => 'nullable|file|mimes:pdf|max:10240', // Allow PDF for book
    //         'brochure' => 'nullable|file|mimes:pdf|max:10240', // Allow PDF for brochure
    //         'paper_format' => 'nullable|file|mimes:pdf|max:10240', // Allow PDF for paper_format
    //         'committe_members' => 'array',
    //         'committe_members.*.name' => 'string',
    //         'committe_members.*.image' => 'string',
    //         'committe_members.*.rank' => 'string',
    //         'committe_members.*.position' => 'nullable|string',
    //         'committe_members.*.speaker_type' => 'in:keynote,invited,none',
    //         'committe_members.*.member_type' => 'in:organizing,program,none',
    //         'committe_members.*.chair_type' => 'in:general chair,general co-chair,program chair,none',
    //         'committe_members.*.nation' => 'string',
    //         'committe_members.*.university' => 'string'
    //     ]);

    //     if ($validator->fails()) {
    //         // Return a JSON response with validation errors and status code 422
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     // Handle image uploads
    //     $imageUrls = [];
    //     if ($request->hasFile('images')) {
    //         $imageUrls = [];
    //         foreach ($request->file('images') as $image) {
    //             // Get the dimensions of the image
    //             list($width, $height) = getimagesize($image);
    //             // Determine the orientation
    //             $orientation = $width > $height ? 'landscape' : 'portrait';
    //             // dd($orientation);

    //             // Generate a unique name for the image with orientation
    //             $imageName = now()->format('YmdHis') . "_{$orientation}_" . $image->getClientOriginalName();
    //             //  dd($imageName);
    //             // Store the image with the custom name
    //             $path = $image->storeAs('conference_images', $imageName, 'public');
    //             $imageUrls[] = $imageName;
    //         }


    //         // Handle PDF uploads for book, brochure, and paper_format
    //         $bookPath = null;
    //         if ($request->hasFile('book')) {
    //             $bookFile = $request->file('book');
    //             $bookPath = now()->format('YmdHis') . '_book_' . $bookFile->getClientOriginalName();
    //             $bookFile->storeAs('conference_files', $bookPath, 'public');
    //         }

    //         $brochurePath = null;
    //         if ($request->hasFile('brochure')) {
    //             $brochureFile = $request->file('brochure');
    //             $brochurePath = now()->format('YmdHis') . '_brochure_' . $brochureFile->getClientOriginalName();
    //             $brochureFile->storeAs('conference_files', $brochurePath, 'public');
    //         }

    //         $paperFormatPath = null;
    //         if ($request->hasFile('paper_format')) {
    //             $paperFormatFile = $request->file('paper_format');
    //             $paperFormatPath = now()->format('YmdHis') . '_paper_format_' . $paperFormatFile->getClientOriginalName();
    //             $paperFormatFile->storeAs('conference_files', $paperFormatPath, 'public');
    //         }

    //         // Create and save the new conference record
    //         $conference = new Conference();
    //         $conference->fill($validator->validated());
    //         $conference->images = implode(",", $imageUrls); // Assign image URLs to the images attribute
    //         $conference->book = $bookPath;
    //         $conference->brochure = $brochurePath;
    //         $conference->paper_format = $paperFormatPath;
    //         $conference->save();

    //         // Handle committe members
    //         if ($request->has('committe_members')) {
    //             foreach ($request->committe_members as $memberData) {
    //                 $member = new CommitteMember($memberData);
    //                 $conference->committe_members()->save($member);
    //             }
    //         }

    //         // Return the newly created conference
    //         return response()->json($conference, 201);
    //     }
    // }


    // public function destroy($id)
    // {
    //     try {
    //         $conf = Conference::findOrFail($id);
    //         $conf->delete();
    //         // Return a JSON response with a success message
    //         return response()->json(['message' => 'Post and associated images deleted successfully'], 200);
    //     } catch (\Exception $e) {
    //         // Return a JSON response with an error message if deletion fails
    //         return response()->json(['error' => 'Failed to delete post and associated images'], 500);
    //     }
    // }

    // public function deleteImage($confId, $imageId)
    // {
    //     try {
    //         // Find the post by ID
    //         $conf = Conference::findOrFail($confId);

    //         // Find the image by ID and delete it
    //         $image = $conf->images()->findOrFail($imageId);
    //         Storage::delete($image->name);

    //         $image->delete();

    //         return response()->json(['message' => 'Image deleted successfully'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Failed to delete image'], 500);
    //     }
    // }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
    //         'title' => 'required',
    //         'conference_date' => 'required',
    //         'description' => 'required',
    //         'topics' => 'required',
    //         'general_chair' => 'required',
    //         'co_chair' => 'required',
    //         'program_chair' => 'required',
    //         'sub_deadline' => 'required',
    //         'accept_noti' => 'required',
    //         'normal_fee' => 'required',
    //         'early_bird_fee' => 'required',
    //         'local_fee' => 'required',
    //         'sub_email' => 'required',
    //         'camera_ready' => 'required',
    //         'brochure' => 'required|file|mimes:pdf|max:10240',
    //         'book' => 'required|file|mimes:pdf|max:10240',
    //         'paper_format' => 'nullable|file|mimes:pdf|max:10240', // Allow PDF for paper_format
    //         'committe_members' => 'array',
    //         'committe_members.*.id' => 'nullable|integer|exists:committe_members,id',
    //         'committe_members.*.name' => 'required|string',
    //         'committe_members.*.rank' => 'required|string',
    //         'committe_members.*.position' => 'nullable|string',
    //         'committe_members.*.speaker_type' => 'required|in:keynote,invited,none',
    //         'committe_members.*.member_type' => 'required|in:organizing,program,none',
    //         'committe_members.*.chair_type' => 'required|in:general chair,general co-chair,program chair,none',
    //         'committe_members.*.nation' => 'required|string',
    //         'committe_members.*.university' => 'required|string'
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         // Return a JSON response with validation errors and status code 422
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     try {
    //         // Find the conference by ID
    //         $conference = Conference::findOrFail($id);

    //         // Update the conference details
    //         $conference->title = $request->title;
    //         $conference->conference_date = $request->conference_date;
    //         $conference->description = $request->description;
    //         $conference->topics = $request->topics;
    //         $conference->general_chair = $request->general_chair;
    //         $conference->co_chair = $request->co_chair;
    //         $conference->program_chair = $request->program_chair;
    //         $conference->paper_sub_guide = $request->paper_sub_guide;
    //         $conference->updated_sub_deadline = $request->updated_sub_deadline;
    //         $conference->accept_noti = $request->accept_noti;
    //         $conference->normal_fee = $request->normal_fee;
    //         $conference->early_bird_fee = $request->early_bird_fee;
    //         $conference->local_fee = $request->local_fee;
    //         $conference->sub_email = $request->sub_email;
    //         $conference->camera_ready = $request->camera_ready;

    //         // Handle PDF uploads for brochure and book
    //         if ($request->hasFile('brochure')) {
    //             $brochureFile = $request->file('brochure');
    //             $brochurePath = now()->format('YmdHis') . '_brochure_' . $brochureFile->getClientOriginalName();
    //             $brochureFile->storeAs('conference_files', $brochurePath, 'public');
    //             $conference->brochure = $brochurePath;
    //         }

    //         if ($request->hasFile('book')) {
    //             $bookFile = $request->file('book');
    //             $bookPath = now()->format('YmdHis') . '_book_' . $bookFile->getClientOriginalName();
    //             $bookFile->storeAs('conference_files', $bookPath, 'public');
    //             $conference->book = $bookPath;
    //         }
    //         if ($request->hasFile('paper_format')) {
    //             $paper_formatFile = $request->file('paper_format');
    //             $paper_formatPath = now()->format('YmdHis') . '_paper_format_' . $paper_formatFile->getClientOriginalName();
    //             $paper_formatFile->storeAs('conference_files', $paper_formatPath, 'public');
    //             $conference->paper_format = $paper_formatPath;
    //         }

    //         $conference->save();

    //         // Update committee members
    //         if ($request->has('committe_members')) {
    //             $memberIds = [];
    //             foreach ($request->committe_members as $memberData) {
    //                 if (isset($memberData['id'])) {
    //                     // Update existing member
    //                     $member = CommitteMember::find($memberData['id']);
    //                     $member->update($memberData);
    //                 } else {
    //                     // Create new member
    //                     $member = new CommitteMember($memberData);
    //                     $conference->committe_members()->save($member);
    //                 }
    //                 $memberIds[] = $member->id;
    //             }

    //             // Remove members not in the request
    //             $conference->committe_members()->whereNotIn('id', $memberIds)->delete();
    //         }

    //         // Process and save the images
    //         if ($request->hasFile('images')) {
    //             $imageUrls = [];
    //             foreach ($request->file('images') as $image) {
    //                 // Get the dimensions of the image
    //                 list($width, $height) = getimagesize($image);

    //                 // Determine the orientation
    //                 $orientation = $width > $height ? 'landscape' : 'portrait';

    //                 // Generate a unique name for the image with orientation
    //                 $imageName = now()->format('YmdHis') . "_{$orientation}_" . $image->getClientOriginalName();

    //                 // Store the image with the custom name
    //                 $path = $image->storeAs('conference_images', $imageName, 'public');
    //                 $imageUrls[] = $imageName;
    //             }

    //             // Assign image URLs to the images attribute
    //             $conference->images = implode(",", $imageUrls);
    //             $conference->save();
    //         }

    //         // Return a JSON response with a success message and status code 200
    //         return response()->json(['message' => 'Conference updated successfully'], 200);
    //     } catch (QueryException $e) {
    //         // Return a JSON response with an error message if updating the conference fails
    //         return response()->json(['error' => 'Failed to update conference'], 500);
    //     }
    // }
}
