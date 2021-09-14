<div class="my-5">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="d-flex  justify-content-between">
        <div class="d-flex">
            <img src="{{ asset('/images/' . $channel->image)  }}" alt="" class="rounded-circle">

            <div class="ml-2">
                <h4>{{ $channel->name }}</h4>
                <div class="grey-text text-sm">{{ $channel->subscriptions()->count() }} Subscribers</div>
            </div>
        </div>

        <div>
            <button wire:click.prevent="toggle"
                class="btn btn-lg text-uppercase {{ $userSubscribed ? 'sub-btn' : 'sub-btn-active' }}">
                {{ $userSubscribed ? 'Unsubscribe' : 'Subscribe' }}
            </button>
        </div>

    </div>
</div>
