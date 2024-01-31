<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Post extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // control how the data is added to the Meilisearch server
    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->title,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'published' => (bool) $this->published,
            // making sure the category id is treated as a number
            'category_id' => (int) $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    // make the data searchable based on this condition
    public function shouldBeSearchable(): bool
    {
        return $this->published;
    }
}