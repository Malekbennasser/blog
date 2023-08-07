<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $validated = $request->validate([
            'content' => 'required|string'
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $postId;
        $comment->user_id = Auth::user()->id; // Set the user_id using the authenticated user's ID 
        $comment->save();


        // return view('welcome');

        return redirect("/posts/$postId");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $postId, string $id)
    {
        // dd($id);
        // dd($postId);
        Comment::find($id)->delete();

        return redirect("/posts/$postId")->with('message', 'Comment deleted succesfully');
    }
}
