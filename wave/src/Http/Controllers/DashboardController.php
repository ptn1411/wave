<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use Wave\Post;
use App\Models\Link;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::with('collections')->paginate(12);

        return view('theme::dashboard.index', compact('links'));
    }
}
