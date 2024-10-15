<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;
use App\Models\Tag;

class Link extends Model
{
    use HasFactory;

    protected $table = 'links';
    protected $fillable = [
        'name',
        'url',
        'type',
        'description',
        'textContent',
        'preview',
        'image',
        'pdf',
        'importDate'

    ];
    public function image()
    {
        return Voyager::image($this->image);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'link_collections', 'link_id', 'collection_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'link_tags', 'link_id', 'tag_id');
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
