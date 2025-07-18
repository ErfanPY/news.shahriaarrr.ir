<div class="mt-5">
    <x-flash-message />
    @auth
            <x-form action="{{ route('comments.store', $post->id) }}" method='POST' >
                <div class="d-flex mt-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('icon.png') }}" width="64" class="rounded-circle mr-3" alt="{{ auth()->user()->username }}">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <textarea name="body" rows="3" placeholder="Write comment here" class="form-control mb-1 @error('body')
                            is-invalid
                        @enderror"></textarea>
                        <button class="btn btn-primary mt-1">Send</button>
                    </div>
                </div>
            </x-form>

    @else
        <p class="text-muted"><a href="{{ route('login') }}">Sign in</a> to leave a comment!</p>
    @endauth
    @foreach ($comments as $comment)
        <div class="d-flex mt-4">
            <div class="flex-shrink-0">
                <img src="{{ asset('icon.png') }}" width="64" class="rounded-circle mr-3" alt="{{ $comment->user->username }}">
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="">{{ $comment->user->username }} <small class="text-muted pl-2">@jalaliDiff($comment->created_at)</small></h5>
                <div>
                    {{ $comment->body }}
                </div>
            </div>
        </div>
    @endforeach


</div>
