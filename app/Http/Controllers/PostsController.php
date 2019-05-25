<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Authorize using Laravel Policies
        $this->authorize('create', Post::class);

        //Select all categories from the database so we can assign them from the view.
        $categories = Category::all('id', 'name');

        //Pass an empty laravel eloquent class so we could use the same form for both update & store
        $post = new Post;

        return view('posts.create', compact('categories', 'post'));
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'imgUrl' => 'required|url',
            'category_id' => 'required|numeric'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Authorize using Laravel Policies
        $this->authorize('create', Post::class);

        $data = $this->validateRequest($request);

        //Insert the validated data into database
        Post::create($data);

        return redirect('/')->with('success', 'A new post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get post by ID 
        $post = Post::findOrFail($id);

        //Get related posts by category
        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Authorize using Laravel Policies
        $this->authorize('update', Post::class);

        //Get post by ID
        $post = Post::findOrFail($id);

        //Select all categories from the database so we can assign them from the view.
        $categories = Category::all('id', 'name');

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Authorize using Laravel Policies
        $this->authorize('update', Post::class);

        $data = $this->validateRequest($request);

        Post::findOrFail($id)->update($data);

        return redirect('/')->with('success', 'Post has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Authorize using Laravel Policies
        $this->authorize('delete', Post::class);

        Post::findOrFail($id)->delete();

        return back()->with('success', 'Post has been deleted');
    }
}
