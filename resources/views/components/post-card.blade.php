<div class="col-md-3 mb-4">
    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">
        <div class="card product-card h-100">
            <img src="{{asset('storage').'/'.$post->url}}" class="card-img-top" alt="تصویر پست">
            <div class="card-body">
                <h5 class="card-title">{{ $post->name }}</h5>
                <p class="card-text text-muted">توضیحات کوتاه خبر</p>
                <small class="text-muted">تاریخ: @jalali($post->created_at)</small>
            </div>
        </div>
    </a>
</div> 