<x-layout title="پست های من">
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">پست های من</h2>
            <div class="row">
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">
                            <div class="card product-card h-100">
                                <img src="/{{ $post->url }}" class="card-img-top" alt="تصویر پست">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->name }}</h5>
                                    <p class="card-text text-muted">توضیحات کوتاه خبر</p>
                                    <small class="text-muted">تاریخ: {{ $post->created_at->format('Y/m/d') }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p class="text-muted">شما هنوز هیچ پستی ایجاد نکرده‌اید.</p>
                        <a href="#" class="btn btn-primary">ایجاد پست جدید</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout> 