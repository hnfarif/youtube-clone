@foreach ($comments as $comment)
<div class="media my-3">
    <img src="{{ asset('/images/' . $comment->user->channel->image) }}" class="mr-3 rounded-circle" style="width: 60px"
        alt="{{ $comment->user->name }}">
    <div class="media-body">
        <h5 class="mt-0">{{ $comment->user->name }}
            <span class="text-muted">{{ $comment->created_at->diffForHumans()}}</span>
        </h5>
        <p>{{ $comment->body }}</p>
        @if ($comment->replies->count())
        <a href="">{{ $comment->replies->count() }} replies</a>
        @include('includes.recursive', ['comments' => $comment->replies])
        @endif
    </div>
</div>
@endforeach
