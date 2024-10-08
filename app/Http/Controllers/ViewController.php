<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;
use Wave\Post;

class ViewController extends Controller
{

    public function incrementPostView($post_id)
    {
        // Kiểm tra xem post_id có tồn tại trong bảng posts không
        $postExists = Post::where('id', $post_id)->exists();

        if (!$postExists) {
            return response()->json([
                'message' => 'Post does not exist'
            ], 404); // Trả về mã lỗi 404 nếu post không tồn tại
        }

        // Tìm hoặc tạo mới bản ghi cho post_id trong bảng views
        $view = View::firstOrCreate(['post_id' => $post_id]);

        // Tăng view_count lên 1
        $view->increment('view_count');

        return response()->json([
            'message' => 'View count incremented',
            'view_count' => $view->view_count
        ]);
    }
}
