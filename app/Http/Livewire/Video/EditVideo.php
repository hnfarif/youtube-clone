<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;

class EditVideo extends Component
{
    public function render()
    {
        return view('livewire.video.edit-video')->extends('layouts.app');
    }
}
