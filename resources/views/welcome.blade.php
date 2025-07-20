<x-layouts.home>
    <x-slider :posts="$slider_posts"/>
    @foreach ($posts as $categoryName => $categoryData)
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">
                <a href={{ "/category/".$categoryData['id']}} >
                    {{ $categoryName }}
                </a>
            </h2>
            <div class="row">
                @foreach ($categoryData['posts'] as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        </div>
    </section>
    @endforeach
</x-layouts.home>
