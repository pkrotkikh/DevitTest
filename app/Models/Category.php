<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_at', 'updated_at'];

    public function posts(): belongsToMany
    {
        return $this->belongsToMany(
            Post::class, "posts_categories", "category_id", "post_id");
    }
}
