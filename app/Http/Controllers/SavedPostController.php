<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\SavedPost;
use Illuminate\Http\Request;


class SavedPostController extends Controller
{
    public function index(Post $post)
    {
        $savedPosts = SavedPost::whereHas('user', function($query) {
            $query->where('id', auth()->id());
        })->with('post')->get();
            
        return view('posts.saved-post',[
            'savedPosts'=>$savedPosts,
            'post'=>$post,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $post = Post::find($request->post_id);

        $savedPost = new SavedPost();
        $savedPost->user_id = $user->id;
        $savedPost->post_id = $post->id;
        $savedPost->save();

        return redirect()->back()->with('success', 'Post saved successfully.');
    }

    public function destroy(Request $request)
    {
        $user = auth()->user();
        $post = Post::find($request->post_id);
    
        $savedPost = SavedPost::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();
    
        if ($savedPost) {
            $savedPost->delete();
            return redirect()->back()->with('success', 'Post unsaved successfully.');
        }
    
        return redirect()->back()->with('error', 'Post not found.');
    }
}
