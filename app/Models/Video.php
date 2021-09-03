<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function channel(){
       return $this->belongsTo(Channel::class);
    }

    public function getThumbnailAttribute()
    {
        if($this->thumbnail_image){
            return '/videos/' . $this->uid. '/'. $this->thumbnail_image;
        }else{
            return '/videos/'. 'default.png';
        }

    }

    public function getRouteKeyName()
    {
        return 'uid';
    }
}
