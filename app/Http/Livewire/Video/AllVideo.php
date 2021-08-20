<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;

class AllVideo extends Component
{
    public function render()
    {
        return view('livewire.video.all-video')->extends('layouts.app');
    }
}
