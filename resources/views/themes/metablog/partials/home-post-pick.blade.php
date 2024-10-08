<section class="py-10">
    <div class="font-work flex items-center justify-between mb-8">
        <h5 class="text-base-content text-2xl font-bold">
            Editor Pick
        </h5>
        <a href="/" class="btn btn-outline btn-secondary text-secondary-content/60 font-medium text-sm">
            View All Post
        </a>
    </div>
    <!----- start Editor Pick  items  ----->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($postEditorPick as $post)
            <div class="card">
                <!-- card body section -->
                <div class="card-body p-4 border border-base-content/10 rounded-xl w-fit">
                    <div class="flex items-center justify-center gap-4 font-work">
                        <figure class="flex-none">
                            <img src="{{ $post->image() ?? 'https://placehold.it/110x90' }}" alt="PostCard_image"
                                class="rounded-md" width="110px" height="190px" />
                        </figure>
                        <div>
                            <h5>
                                <a href="{{ $post->link() }}"
                                    class="font-work font-semibold text-base text-base-content leading-5 hover:text-primary transition hover:duration-300">
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
    <!----- start Editor Pick  items  ----->
</section>
