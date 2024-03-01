<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function getOnlyAllPosts(){
        return view("posts.allposts",[
            "posts" => Post::latest()->paginate(10)
        ]);
    }

    public function getUserPosts(){
        $posts = [];
        if (auth()->check()) {
            $posts = auth()->user()->usersPosts()->latest()->get();
        }
        return view('test', ['posts' => $posts]);
    }

    public function destroy(Post $post){
        if (auth()->id() == $post['user_id']) {
            $post->delete();
        } /* else{
            return redirect('/', 403);
        } doesn't work: getting error InvalidArgument: 403 (no access) is not a redirect status code*/
        return redirect()->route("dashboard")->with("success", "Post deleted");

    }
    public function update(Post $post, Request $request){
        if (auth()->user()->id == $post['user_id']) {
            $incomingFields = $request->validate([
                'title' => 'required|min:5|max:50',
                'body' => 'required|min:10|max:255'
            ]);        
            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['body'] = strip_tags($incomingFields['body']);
            
            $post->update($incomingFields);
        }
        return view("posts.standalonepost", ["post" => $post]);
    }
    public function showEdit(Post $post){
        if (auth()->user()->id !== $post['user_id']) {
            return redirect()->route("dashboard");
        }
        return view('posts.edit-post', ['post' => $post]);
    }

    public function store(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required|min:5|max:240',
            'body' => 'required|min:10|max:700'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect()->route("dashboard")->with("success", "Post created!");
    }

    public function show(Post $post){
        return view("posts.standalonepost", ["post" => $post]);
    }
}