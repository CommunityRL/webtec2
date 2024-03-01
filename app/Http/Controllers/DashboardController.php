<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(){
        
        $posts = Post::latest();

        if (request()->has("search")) {
            $posts = $posts->where("body", "like", "%" . request()->get("search", "") . "%");
        }
        
        return view('home', [
            'posts' => $posts->paginate(4)
        ]);
    }
}
