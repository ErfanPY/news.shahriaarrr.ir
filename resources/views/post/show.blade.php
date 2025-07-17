<x-layout title="Image {{$post->name}}">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-9">
                <div class="image-container">
                    <img src="{{ $post->url }}" class="img-fluid" />
                </div>
                <div>
                    <h1>{{$post->name}}</h1>
                    <br>
                    <p>
                        {{$post->body}}
                    </p>
                </div>

                {{-- @include('image.partials._related_photos') --}}
                @include('post._comments')

            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://www.gravatar.com/avatar/c1d58af78e2086e8348f0f3b70425b25?d=mp&amp;s=60"
                        alt="Author" class="rounded-circle mr-3">
                    <div class="ms-3">
                        <h5><a href="#" class="text-decoration-none">{{$post->user->name}}</a></h5>
                        {{-- <p class="text-muted mb-0">{{$post->user->getImagesCount()}}</p> --}}
                    </div>
                </div>



                {{-- <div class="bg-light mt-3 p-3 border">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <th>Uploaded</th>
                                <td>{{$image->uploadDate()}}</td>
                            </tr>
                            <tr>
                                <th>Dimensions</th>
                                <td>{{$image->dimension}}</td>
                            </tr>
                            <tr>
                                <th>Views</th>
                                <td>{{$image->views_count}}</td>
                            </tr>
                            <tr>
                                <th>Downloads</th>
                                <td>{{$image->downloads_count}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}

                {{-- <div class="tagcloud mt-3">
                    <ul>
                        <li><a href="#">Nature</a></li>
                        <li><a href="#">Mountain</a></li>
                        <li><a href="#">Blue</a></li>
                        <li><a href="#">Forest</a></li>
                        <li><a href="#">Animal</a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</x-layout>
