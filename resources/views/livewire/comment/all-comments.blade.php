<div>
    {{-- Stop trying to control. --}}

    <h4>{{ $video->allCommentsCount() }} Comments</h4>
    @include('includes.recursive', ['comments' => $video->comments])

</div>
