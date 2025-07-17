<div class="col-md-3 mb-4">
    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">
        <div class="card product-card h-100">
            <img src="{{ $post->url }}" class="card-img-top" alt="تصویر پست">
            <div class="card-body">
                <h5 class="card-title">{{ $post->name }}</h5>
                <p class="card-text text-muted">توضیحات کوتاه خبر</p>
                @if(isset($showDate) && $showDate)
                    <small class="text-muted">تاریخ: {{ $post->created_at->format('Y/m/d') }}</small>
                @endif
            </div>
        </div>
    </a>
</div> 