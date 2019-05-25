<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Post;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Fetch all posts from DB using Eloquent.
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('index', compact('posts'));
    }
}
