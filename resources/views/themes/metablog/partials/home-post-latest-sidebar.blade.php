<div class="p-8 border border-base-content/10 rounded-xl w-full">
    <h5 class="text-base-content font-bold text-2xl font-work">
        Latest Post
    </h5>
    <!-------- post list card without border component -------->
    <div class="grid grid-cols-1 gap-6 mt-8">
        @foreach ($randomPosts as $post)
        <div class="card">
            <!-- card body section -->
            <div class="card-body p-0">
                <div class="flex items-center gap-4 font-work">
                    <figure class="flex-none">
                        <img src="{{ $post->image() ?? 'https://placehold.it/110x90' }}" alt="PostCard_image"
                            class="rounded-md" width="110px" height="190px" />
                    </figure>
                    <div>
                        <h5>
                            <a href="{{ $post->link() }}"
                                class="font-work line-clam-2 font-semibold text-base text-base-content leading-5 hover:text-primary transition hover:duration-300">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <p class="mt-2.5 text-base-content/60 text-sm">
                            {{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>