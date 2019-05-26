<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('create', Post::class);

        //Get All users from DB
        $users = User::all('id','name', 'email', 'isAdmin', 'created_at');

        return view('users.index', compact('users'));
    }

    public function changeRole($id, $type)
    {
        $this->authorize('create', Post::class);

        $user = User::findOrFail($id);

        $user->isAdmin = $type == 'admin' ? 1 : 0;
        $user->save();

        return back()->with('success', "The user role has been changed to $type.");
    }
}
