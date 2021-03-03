<div>
    {{-- The best athlete wants his opponent at his best. --}}
    @foreach($users as $user)
        <div>
            {{ $user->present()->name }}{{ $loop->last ? null : ','  }}
        </div>
    @endforeach
</div>
