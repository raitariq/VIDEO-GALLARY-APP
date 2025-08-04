<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(){
        $videos = Video::all();
        return view("frontend.index",compact('videos'));
    }
    public function toggleLike(Video $video)
    {
        $user = auth()->user();
    
        $like = $video->likes()->where('user_id', $user->id)->first();
    
        if ($like) {
            // User already liked - remove like (unlike)
            $like->delete();
            $liked = false;
        } else {
            // User has not liked - add like
            $video->likes()->create([
                'user_id' => $user->id,
            ]);
            $liked = true;
        }
    
        // Return JSON response with new status and total likes count
        return response()->json([
            'liked' => $liked,
            'likes_count' => $video->likes()->count(),
        ]);
    }

public function comment(Request $request, Video $video)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $comment = $video->comments()->create([
        'user_id' => auth()->id(),
        'comment' => $request->comment,
    ]);

    // Return the comment with user info to show immediately
    $comment->load('user');

    return response()->json([
        'message' => 'Comment posted',
        'comment' => $comment,
        'user' => $comment->user,
    ]);
}
}
