<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Posts;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest();
        return view('posts.comment', compact('comments', $comments));
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $post = Posts::find($request->get('post_id'));
        $post->comments()->save($comment);

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
