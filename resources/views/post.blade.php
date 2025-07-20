<x-layouts.home title="Image {{$post->name}}">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-9">
                <div class="image-container">
                    <img src={{ $post->image ? asset('storage/'.$post->image) : "https://picsum.photos/200" }} class="img-fluid" />
                </div>
                <div>
                    <h1>{{$post->name}}</h1>
                    <br>
                    <p>
                        {{$post->body}}
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://www.gravatar.com/avatar/c1d58af78e2086e8348f0f3b70425b25?d=mp&amp;s=60"
                        alt="Author" class="rounded-circle mr-3">
                    <div class="ms-3">
                        <h5><a href="#" class="text-decoration-none">{{$post->user->name}}</a></h5>
                    </div>
                </div>
            </div>
        </div>
        <x-comment :post="$post" />
        <x-comments :post="$post" />
    </div>
</x-layouts.home>
