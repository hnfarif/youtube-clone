<div>
    {{-- Stop trying to control. --}}

    @include('includes.recursive', ['comments' => $video->comments()->latestFirst()->get()])

</div>
