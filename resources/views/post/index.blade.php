<x-layout title="Discover free Images">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col"></div>
            <div class="col text-right">
                <form class="search-form">
                    <input type="search" name="q" placeholder="Search..." aria-label="Search..." autocomplete="off">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="row image-grid" data-masonry='{"percentPosition": true }'>
            @foreach($posts as $post )
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card">
                    <a href="{{route('post.show',$post->id)}}">
                        <img src="/{{ $post->url }}" alt="{{$post->title}}"
                         height="100%"
                            class="card-img-top">
                    </a>
                    <h3>{{$post->url}}</h3>

                </div>
            </div>
            @endforeach
        </div>

        {{ $posts->links() }}
    </div>

</x-layout>



