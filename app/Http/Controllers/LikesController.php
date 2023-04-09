<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function likePost(Request $request)
    {
        $postId = $request->input('post_id');
        $likedPosts = session()->get('liked_posts', []);
    
        if (in_array($postId, $likedPosts)) {
            // User has already liked the post, so unlike it
            $this->unlikePost($request);
        } else {
            // User has not liked the post yet, so like it
            $post = Post::findOrFail($postId);
            $post->likes()->create([
                'user_id' => auth()->id()
            ]);
    
            // Store the post ID in the user's session
            $likedPosts[] = $postId;
            session()->put('liked_posts', $likedPosts);
        }
    
        return back();
    }
    

    public function unlikePost(Request $request)
    {
        $postId = $request->input('post_id');
        $likedPosts = session()->get('liked_posts', []);
    
        // Remove the post ID from the list of liked posts
        $likedPosts = array_diff($likedPosts, [$postId]);
        session()->put('liked_posts', $likedPosts);
    
        // Delete the like from the database
        $post = Post::findOrFail($postId);
        $post->likes()->where('user_id', auth()->id())->delete();
    
        return back();
    }

}
