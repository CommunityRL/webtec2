<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function getAllPosts(){
        return view('test', [
            'posts' => Post::latest()->paginate(5)
        ]);
    }
    public function getPosts(){
        $posts = [];
        if (auth()->check()) {
            $posts = auth()->user()->usersCoolPosts()->latest()->get();
        }
        return view('home', ['posts' => $posts]);
    }

    public function deletePost(Post $post){
        if (auth()->user()->id == $post['user_id']) {
            $post->delete();
        }
        return redirect('/');

    }
    public function actuallyUpdatePost(Post $post, Request $request){
        if (auth()->user()->id == $post['user_id']) {
            $incomingFields = $request->validate([
                'title' => 'required',
                'body' => 'required'
            ]);        
            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['body'] = strip_tags($incomingFields['body']);
            
            $post->update($incomingFields);
        }
        return redirect('/');
    }
    public function showEditScreen(Post $post){
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required|min:5|max:240',
            'body' => 'required|min:10|max:700'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect()->route("dashboard2")->with("success", "Post created successfully!");
    }
}