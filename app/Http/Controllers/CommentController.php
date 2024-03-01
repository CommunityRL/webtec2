<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /* public function store(Post $post){

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->body = request()->get("body");
        $comment->save();

        return redirect()->route("posts.show" , ["post" => $post->id])->with("success", "Commented!");
    } */

    public function store(Post $post, Request $request){
        $incomingFields = $request->validate([
            'body' => 'required|min:10|max:500'
        ]);
        $incomingFields['post_id'] = $post->id;
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Comment::create($incomingFields);
        return redirect()->route("dashboard")->with("success", "Commmented!");
    }
}
