<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::all();
        // dd($posts);
        return view('post.index', ['posts' => $posts]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {

            return view('post.create');
        }
        return redirect('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);

        $slug = Str::slug($request->title, '_');
        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);



        $post = new Post();
        $post->image = $newImageName;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id; // Set the user_id using the authenticated user's ID 
        $post->save();

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        // dd($post);

        $comments = Comment::whereIn('post_id', [$id])->get();
        $likes = Like::whereIn('post_id', [$id])->get();
        $commentsCount = count($comments);
        $likesCount = count($likes);
        // dd($commentsCount);

        //recovering the user name with the id


        return view('post.show')->with([
            //comments
            'post' => $post,
            'comments' => $comments,
            'commentsCount' => $commentsCount,
            'likesCount' => $likesCount


        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::check() && $post->user->id == Auth::user()->id) {
            // dd($post);

            return view('post.edit', compact('post'));
        }
        return redirect('login');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $imageName)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);


        $photoPath = public_path('images/' . $imageName);

        if (File::exists($photoPath)) {
            File::delete($photoPath);
        }

        $slug = Str::slug($request->title, '_');
        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $updatedPost = Post::findOrFail($id);
        $updatedPost->image = $newImageName;
        $updatedPost->title = $request->title;
        $updatedPost->content = $request->content;
        $updatedPost->updated_at = now();
        $updatedPost->save();

        return redirect('/posts')->with('message', 'Post updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::find($id)->delete();

        return redirect('/posts')->with('message', 'Post deleted succesfully');
    }
}
