<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->user()->id; // assuming you have user authentication set up
        $comment->body = $request->body;
        $comment->save();

        return redirect()->back()->with('success', 'Comment submitted successfully!');
    }
    public function destroy(Comment $comment)
    {
        if(Auth::user()->id !== $comment->user_id) {
            return back()->with('error', 'You are not authorized to delete this comment');
        }
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }
}
