<div>
    This is where the users go
    @foreach($users->user as $user)
        <div>
            {{ $user->present()->name }}{{ $loop->last ? null : ','  }}
        </div>
    @endforeach
</div>
