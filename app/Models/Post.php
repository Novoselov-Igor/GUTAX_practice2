<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 1;
    public const STATUS_PUBLISHED = 2;
    public const STATUS_ARCHIVED = 3;

    protected $fillable = [
        'title',
        'content',
        'tags',
        'status',
        'author_id'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
