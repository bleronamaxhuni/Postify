<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(Post $post)
    {
        $user = Auth::user();
        $posts = Post::where('user_id', '=', $user->id)->with(['user'])->get();
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post['user_id']=Auth::user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $post->image = $filename;
        }

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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $post->image = $filename;
        }

        $post->save();

        return redirect('/posts')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('message', "Post has been deleted");
    }
}
