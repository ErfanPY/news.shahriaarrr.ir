<div class="comments-list mt-5">
    <h4 class="mb-4">نظرات ({{ $post->comments->count() }})</h4>
    
    @if($post->comments->isEmpty())
        <div class="alert alert-info">هنوز نظری ثبت نشده است.</div>
    @else
        <div class="list-group">
            @foreach($post->comments as $comment)
                <div class="list-group-item mb-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1">{{ $comment->user->name }}</h6>
                            <p class="mb-1">{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at_jalali }}</small>
                        </div>
                        @auth
                            @if(auth()->id() === $comment->user_id)
                                <form action="{{ route('dashboard.comments.delete', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>