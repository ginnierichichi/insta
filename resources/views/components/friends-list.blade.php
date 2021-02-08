<div>
    <div>Following</div>
    <ul>
        @foreach (auth()->user()->follows as $user)
        <li>
            <div>
                <img src="{{ $user->avatar }}">
            </div>
            {{ $user->name }}
        </li>
        @endforeach
    </ul>
</div>
