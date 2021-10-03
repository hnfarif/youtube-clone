@extends('layouts.app')

@section('content')

<div class="jumbotron jumbotron-fluid bg-primary">
    <div class="container">
        <h1 class="display-4">
            {{ $channel->name }}

        </h1>
        <p class="lead">
            {{ $channel->description }}
        </p>
    </div>
</div>
<div class="container">
    <div class="d-flex align-items-center">
        <img src="{{ asset('/images/'.$channel->image) }}" class="rounded-circle mr-3" height="130px;" alt="">
        <div>
            <h3>{{ $channel->name }}</h3>
            <p>{{ $channel->subscribers() }} Subscribers</p>
        </div>
        @can('update', $channel)

        <a href="{{ route('channel.edit',$channel) }}" class="btn btn-primary ml-auto">Edit Channel</a>
        @endcan

    </div>

    <div>
        <div class="row my-4">

            @foreach ($channel->videos as $video)
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('video.watch', $video) }}" class="card-link">
                    <div class="card mb-4" style="width: 333px; border: none;">
                        <img src="{{ asset($video->thumbnail) }}" alt="Card image cap"
                            style="height: 174px; width:333px;">

                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/images/'.$video->channel->image) }}" alt="" height="40px"
                                    class="rounded-circle">
                                <h4 class="ml-3">{{ $video->title }}</h4>

                            </div>
                            <p class="text-grey mt-4 font-weight-bold" style="line-height: 0.2px;">
                                {{ $video->channel->name }}</p>
                            <p class="text-grey font-weight-bold" style="line-height: 0.2px;">{{ $video->views }} views
                                -
                                {{ $video->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
