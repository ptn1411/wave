<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wave\Post;

class View extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'view_count'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
