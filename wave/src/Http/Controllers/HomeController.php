<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Wave\Post;
use Wave\Category;
use Illuminate\Support\Facades\DB;
use App\Models\View;
use Carbon\Carbon;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (setting('auth.dashboard_redirect', true) != "null") {
            if (!Auth::guest()) {
                return redirect('dashboard');
            }
        }
        $topPostIds = $this->getTopPostIds();
        $categoryId = 1;
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $trendingPosts = Post::whereIn('id', $topPostIds)->get();
        $posts = Post::orderBy('created_at', 'DESC')->take(5)->get();

        $postEditorPick = Post::where('category_id', $categoryId)->take(6)->get();

        $weeklyPosts = Post::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->take(3) // Giới hạn lấy 3 bài
            ->get();

        $latestPosts = Post::latest() // Sắp xếp theo created_at giảm dần
            ->take(4) // Lấy 3 bài
            ->get();

        $randomPosts = Post::inRandomOrder() // Lấy các bài viết theo thứ tự ngẫu nhiên
            ->take(6) // Giới hạn kết quả là 6 bài viết
            ->get();

        $categories = Category::withCount('posts') // Đếm số lượng bài viết trong mỗi category
            ->latest() // Lấy các category mới nhất
            ->take(6) // Giới hạn kết quả là 6 category
            ->get();

        $seo = [

            'title'         => setting('site.title', 'Laravel Wave'),
            'description'   => setting('site.description', 'Software as a Service Starter Kit'),
            'image'         => url('/og_image.png'),
            'type'          => 'website'

        ];

        return view('theme::home', compact('seo', 'posts', 'trendingPosts', 'postEditorPick', 'weeklyPosts', 'latestPosts', 'randomPosts', 'categories'));
    }
    public function getTopPostIds()
    {
        // Lấy 4 view_count lớn nhất và chỉ trả về post_id dưới dạng array
        return View::orderBy('view_count', 'desc')
            ->take(4)
            ->pluck('post_id')
            ->toArray(); // Ép thành mảng
    }
}