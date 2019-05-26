<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function addComment(Request $request, $postId)
    {
        //Validate the request
        $request->validate([
            'comment' => 'required|string',
            'email' => 'required|email'
        ]);

        $request->request->add(['post_id' => $postId]);

        Comment::insert($request->except('_token'));

        return back()->with('success', 'A new comment has been added!');
    }
}
