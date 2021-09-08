<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function channel(){
       return $this->belongsTo(Channel::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function getThumbnailAttribute()
    {
        if($this->thumbnail_image){
            return '/videos/' . $this->uid. '/'. $this->thumbnail_image;
        }else{
            return '/videos/'. 'default.png';
        }

    }

    public function getUploadedDateAttribute()
    {
        $d = new Carbon($this->created_at);

        return $d->toFormattedDateString();
    }

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function doesUserLikedVideo()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function doesUserDislikedVideo()
    {
        return $this->dislikes()->where('user_id', auth()->id())->exists();
    }
}
