<?php

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

if (!function_exists('generateTokenForUser')) {
    /**
     * Generate JWT token for the authenticated user.
     *
     * @return string|null
     */
    function generateTokenForUser()
    {
        // Lấy user đã được xác thực
        $user = Auth::user();

        // Kiểm tra xem user có tồn tại hay không
        if (isset($user->id)) {
            // Tạo token cho user
            return JWTAuth::fromUser($user, [
                'exp' => config('wave.api.key_token_expires', 1)  // Thời gian hết hạn của token
            ]);
        }

        // Trả về null nếu không có user hợp lệ
        return null;
    }
}
