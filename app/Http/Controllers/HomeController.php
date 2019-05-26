<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;

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

        //Fetch all categories from DB so users can filter using categories

        $categories = Category::all('id', 'name');

        return view('index', compact('posts', 'categories'));
    }
}
