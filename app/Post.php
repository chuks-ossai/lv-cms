<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'content', 'img_url', 'published_at', 'category_id', 'user_id'];

    public function removeImage() {
        unlink('storage/' . $this->img_url);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function hasTag($tagId) {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function scopeSearched($query) {
        $search = request()->query('search');
        if(!$search) {
            return $query;
        }

        return $query->where('title', 'LIKE', "%{$search}%");
    }
}

