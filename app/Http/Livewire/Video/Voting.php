<?php

namespace App\Http\Livewire\Video;

use App\Models\Dislike;
use App\Models\Like;
use App\Models\Video;
use Livewire\Component;

class Voting extends Component
{
    public $video;
    public $likes;
    public $dislikes;
    public $likeActive;
    public $dislikeActive;

    protected $listeners = [

        //refresh ini magic function
        'load_values' => '$refresh'
    ];

    public function mount(Video $video)
    {
        $this->video = $video;
        $this->checkIfLiked();
        $this->checkIfDisliked();
    }

    public function checkIfLiked()
    {
        $this->video->doesUserLikedVideo() ? $this->likeActive = true : $this->likeActive = false;
    }

    public function checkIfDisliked()
    {
        $this->video->doesUserDislikedVideo() ? $this->dislikeActive = true : $this->dislikeActive = false;
    }

    public function render()
    {
        $this->likes = $this->video->likes->count();
        $this->dislikes = $this->video->dislikes->count();
        return view('livewire.video.voting')->extends('layouts.app');
    }

    public function like()
    {
        //check if user already like the videos

        if ($this->video->doesUserLikedVideo()) {
            Like::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();

            $this->likeActive = false;
        }else{

            $this->video->likes()->create([

                'user_id' => auth()->id()
            ]);
            $this->disableDislike();
            $this->likeActive = true;
        }

        $this->emit('load_values');
    }

    public function dislike()
    {
        //check if user already disliked the videos

        if ($this->video->doesUserDislikedVideo()) {
            Dislike::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();

            $this->dislikeActive = false;
        }else{


            $this->video->dislikes()->create([

                'user_id' => auth()->id()
            ]);
            $this->disableLike();
            $this->dislikeActive = true;
        }
        $this->emit('load_values');

    }

    public function disableDislike()
    {
        Dislike::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();
        $this->dislikeActive = false;

    }

    public function disableLike()
    {
        Like::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();

        $this->likeActive = false;
    }
}
