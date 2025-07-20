<x-layouts.home title="home">
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">{{ $name }}</h2>

            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="جستجو در این دسته‌بندی..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">جستجو</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                    {{ $posts->links() }}
                @else
                    <div class="col-12 text-center">
                        <p>هنوز خبری برای این بخش ثبت نشده.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layouts.home>
