<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'size', 'mime_type', 'article_id'
    ];

    /**
     * Get Size
     * @return integer
     */
    public function getSize()
    {
        return Self::sum('size');
    }
}
