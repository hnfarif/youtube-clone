<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Channel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function getPictureAttribute()
    {
        if($this->image){
            return '/images/'. $this->image;
        }else{
            return '/images/'. 'channel-default.png';
        }

    }

    public function videos(){
        return $this->hasMany(Video::class);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function subscribers()
    {
        return $this->subscriptions->count();
    }
}
