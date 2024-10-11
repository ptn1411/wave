<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use Wave\Post;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $randomPosts = Post::inRandomOrder() // Lấy các bài viết theo thứ tự ngẫu nhiên
            ->take(6) // Giới hạn kết quả là 6 bài viết
            ->get();
        $seo = [
            'seo_title' => 'Contact-us',
            'seo_description' => 'Contact-us',
        ];
        return view('theme::contact', compact('seo', 'randomPosts'));
    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:250',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $contact = Contact::create([
            'name' => $request->name,
            'subject' => $request->subject,
            'email' => $request->email,
            'message' => $request->message,
            'ip_address' => $request->ip(),
        ]);
        return redirect()->back()->with(['message' => 'Your message has been sent successfully!', 'message_type' => 'success']);
    }
}