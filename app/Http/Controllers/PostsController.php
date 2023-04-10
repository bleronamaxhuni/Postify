<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Post;
use App\Models\SavedPost;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(Post $post)
    {
        // $user = Auth::user();
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->created_at = Carbon::parse($post->created_at)->diffForHumans();
            $post->comments = $post->comments()->with(['user'])->get();
        }
        return view('posts.posts', [
            'posts' => $posts,
            'post'=>$post,
        ]);
    }    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post['user_id']=Auth::user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $user=Auth::user();
        if($post->user_id !== $user->id){
            return redirect()->back()->with('error', 'This post does not exist.');
        }
        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return redirect('/posts')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('message', "Post has been deleted");
    }
    public function dashboard(Post $post)
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        $latestPosts = Post::where('user_id', $user->id)->latest()->take(6)->get();
        $postCount = Post::where('user_id', $user->id)->count();
        $likeCount = Likes::whereHas('user', function($query) {
            $query->where('id', auth()->id());
        })->count();
        $savedPostCount = SavedPost::where('user_id', $user->id)->count();
    
        return view('posts.dashboard', [
            'posts' => $posts,
            'post'=>$post,
            'latestPosts'=>$latestPosts,
            'postCount' => $postCount,
            'likeCount' => $likeCount,
            'savedPostCount'=>$savedPostCount,
        ]);
    }
}
