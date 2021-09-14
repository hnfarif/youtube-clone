<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
       return $this->belongsTo(Video::class);
    }

    public function replies()
    {
       return $this->hasMany(Comment::class, 'reply_id', 'id');
    }
}
