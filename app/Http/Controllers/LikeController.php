<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        // Check if the user has already liked the post
        $existingLike = Like::where('user_id', auth()->user()->id)->where('post_id', $post->id)->first();

        if ($existingLike) {
            // User has already liked the post, so remove the like
            $existingLike->delete();
        } else {
            // User has not liked the post, so add a like
            $like = new Like();
            $like->user_id = auth()->user()->id;
            $like->post_id = $post->id;
            $like->save();
        }
        return redirect("/posts/$postId");
        //

    }
}
