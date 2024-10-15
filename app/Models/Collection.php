<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Link;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collections';
    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'isPublic'
    ];
    public function scopeCurrentUser($query)
    {
        return Auth::user()->hasRole('admin') ? $query : $query->where('author_id', Auth::user()->id);
    }
    public function links()
    {
        return $this->belongsToMany(Link::class, 'link_collections', 'collection_id', 'link_id');
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
