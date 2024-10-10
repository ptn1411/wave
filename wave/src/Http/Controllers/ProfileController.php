<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use Wave\Post;

class ProfileController extends Controller
{
    public function index($username)
    {
        $user = config('wave.user_model')::where('username', '=', $username)->firstOrFail();

        $posts = Post::where('author_id', $user->id)->orderBy('created_at', 'DESC')->paginate(9);

        return view('theme::profile', compact('user', 'posts'));
    }
}
