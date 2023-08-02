<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;

    public const STATUS_APPROVED = 1;

    protected $fillable = [
        'content',
        'status',
        'author',
        'email',
        'url',
        'post_id'
    ];

    public function post() : HasOne
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }
}
