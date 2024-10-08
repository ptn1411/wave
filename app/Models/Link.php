<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;

class Link extends Model
{
    use HasFactory;

    public function image()
    {
        return Voyager::image($this->image);
    }

    public function scopeCurrentUser($query)
    {
        return Auth::user()->hasRole('admin') ? $query : $query->where('author_id', Auth::user()->id);
    }

    public function save(array $options = [])
    {
        // If no owner has been assigned, assign the current user's id as the owner of the workstation
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->getKey();
        }

        return parent::save();
    }
}
