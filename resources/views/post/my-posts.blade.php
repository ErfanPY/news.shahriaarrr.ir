<x-layout title="پست های من">
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2>پست های من</h2>
                <a href="/panel/posts/create" class="btn btn-primary">ایجاد پست جدید</a>
            </div>
            <div class="row">
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                        <x-post-card :post="$post"/>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p class="text-muted">شما هنوز هیچ پستی ایجاد نکرده‌اید.</p>
                        <a href="/panel/posts/create" class="btn btn-primary">ایجاد پست جدید</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout> 