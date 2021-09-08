<?php

namespace App\Http\Livewire\Video;

use App\Models\Video;
use Livewire\Component;

class WatchVideo extends Component
{
    public $video;
    // listener untuk melakukan trigger di javascript menggunakan array dengan format VideoViewed sebagai nama eventya dan countView sebagai function yanng akan dijalankan
    protected $listeners = ['VideoViewed' => 'countView'];

    public function mount(Video $video)
    {
        $this->video = $video;
    }
    public function render()
    {
        return view('livewire.video.watch-video')->extends('layouts.app');
    }

    public function countView()
    {
        $this->video->update([
            'views' => $this->video->views + 1,
        ]);
    }
}
