<section class="py-10">
    <div class="font-work flex items-center justify-between mb-8">
        <h5 class="text-base-content text-2xl font-bold">
            Trending Post
        </h5>
        <a href="/" class="btn btn-outline btn-secondary text-secondary-content/60 font-medium text-sm">
            View All Post
        </a>
    </div>
    <!-----Start Trending Post card items  ----->
    <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
        @foreach ($trendingPosts as $post)
            <div class="card relative w-fit h-fit font-work">
                <!-- Card Image -->
                <div class="min-h-[320px]">
                    <figure class="h-full max-w-full">
                        <img src="{{ $post->image() ?? 'https://placehold.it/700x700' }}" alt="post-card"
                            class="rounded-xl min-h-[320px] h-full object-cover" />
                    </figure>
                </div>
                <div class="card-body gap-0 absolute bottom-0 rounded-xl w-full z-20 p-6">
                    <div class="flex flex-wrap items-center gap-1.5">
                        <div class="badge bg-primary border-0 rounded-md">
                            {{ $post->category->name ?? 'Uncategorized' }}
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ $post->link() }}">
                            <h2
                                class="text-lg font-semibold line-clam-3 text-neutral-content hover:text-primary transition hover:duration-300 line-clamp-3">
                                {{ $post->title }}
                            </h2>
                        </a>
                    </div>
                </div>
                <!-- overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl"></div>
            </div>
        @endforeach
    </div>
    <!-----End Trending Post card items  ----->
</section>
