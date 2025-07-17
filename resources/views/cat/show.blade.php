
<x-layout title="home">
    {{-- @foreach ( $posts as $index => $cat ) --}}
<section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">{{ $name }}</h2>
            <div class="row">
                @foreach ( $posts as $post )
                <div class="col-md-3 mb-4">
                    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">
                        <div class="card product-card h-100">
                            <img src="{{ $post->url }}" class="card-img-top" alt="محصول">
                            <div class="card-body">
                                <h5 class="card-title">{{$post->name}} </h5>
                                <p class="card-text text-muted">توضیحات کوتاه خبر</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    {{-- @endforeach --}}
</x-layout>
