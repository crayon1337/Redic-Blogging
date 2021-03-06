<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class CategoriesController extends Controller
{

    public function getPostsbyCategory($id)
    {
        $posts = Post::where('category_id', $id)->orderBy('created_at', 'desc')->get();

        //Select all categories from the database so we can assign them from the view.
        $categories = Category::all('id', 'name');

        return view('posts.filtered', compact('posts', 'categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // To implement showing categories
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories'
        ]);

        Category::create($data);

        return back()->with('success', 'A new category has been added!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // To be implemented
    }
}
