<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['uid', 'title', 'link', 'description', 'author_name', 'created_at', 'updated_at'];
    protected $with = ["categories"];


    public function categories(): belongsToMany
    {
        return $this->belongsToMany(
            Category::class, "posts_categories", "post_id", "category_id");
    }
}
