<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;
use Livewire\WithPagination;

class AllVideo extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->videos = auth()->user()->channel->videos;
    }
    public function render()
    {
        return view('livewire.video.all-video')->with('videos', auth()->user()->channel->videos()->paginate(3))->extends('layouts.app');
    }
}
