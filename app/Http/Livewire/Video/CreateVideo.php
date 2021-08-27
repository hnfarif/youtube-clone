<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVideo extends Component
{
    use WithFileUploads;
    public Channel $channel;
    public Video $video;
    public $videoFile;

    public function mount(Channel $channel){

        $this->channel = $channel;
    }

    public function render()
    {
        return view('livewire.video.create-video')
        ->extends('layouts.app');
    }

    public function fileCompleted(){

        dd('File Upload');

    }


}
