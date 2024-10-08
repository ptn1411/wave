<div class="flex flex-col md:flex-row gap-6">
    @foreach ($posts as $index => $post)
    @if ($index == 0)
    <!-- start large banner card -->
    <div class="w-full md:w-6/12">
        <div class="card relative w-fit h-fit font-work">
            <!-- Card Image -->
            <div class="min-h-[370px] sm:min-h-[660px]">
                <figure class="h-full max-w-full">
                    <img src="{{ $post->image() ?? 'https://placehold.it/700x700' }}" alt="post-card"
                        class="rounded-xl min-h-[370px] sm:min-h-[660px] h-full object-cover" />
                </figure>
            </div>
            <div class="card-body gap-0 absolute bottom-0 rounded-xl w-full z-20 p-5 sm:p-10">
                <div class="flex flex-wrap items-center gap-1.5">
                    <div class="badge bg-primary border-0 rounded-md">
                        {{ $post->category->name ?? 'Uncategorized' }}
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ $post->link() }}">
                        <h2
                            class="text-lg sm:text-xl line-clam-3 md:text-3xl lg:text-4xl font-semibold text-neutral-content hover:text-primary transition hover:duration-300 line-clamp-3">
                            {{ $post->title }}
                        </h2>
                    </a>
                </div>
                <!-- user info and date -->
                <div class="mt-5 flex items-center gap-5">
                    <div class=" flex items-center gap-3">
                        <!-- user avatar -->
                        <div class="avatar">
                            <div class="w-9 rounded-full">
                                <img src="{{ $post->user->avatar() ?? 'https://placehold.it/100x100' }}" alt="avatar" />
                            </div>
                        </div>
                        <h5>
                            <a href="#"
                                class="text-neutral-content font-medium hover:text-primary transition hover:duration-300">
                                {{ $post->user->name }}
                            </a>
                        </h5>
                    </div>
                    <p class="text-neutral-content">
                        {{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}</p>
                </div>
            </div>

            <!-- overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl"></div>
        </div>
    </div>
    <!-- end large banner card -->
    @else
    <!-- small banner cards -->
    @if ($index == 1)
    <div class="w-full md:w-6/12 grid grid-cols-1 sm:grid-cols-2 gap-5">
        @endif
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
        @if ($index == 4)
    </div>
    @endif
    @endif
    @endforeach
</div>