<?php

namespace App\Http\Livewire\Comment;

use App\Models\Video;
use Livewire\Component;

class AllComments extends Component
{

    public $video;

    public function mount(Video $video)
    {
        $this->video = $video;
    }
    public function render()
    {
        return view('livewire.comment.all-comments');
    }
}
