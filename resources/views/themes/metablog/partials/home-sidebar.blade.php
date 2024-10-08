<section class="py-10">
    <div class="flex flex-col lg:grid lg:grid-cols-12 gap-8 items-start">
        <!---------- Body Component --------->
        <div class="col-span-12 lg:col-span-8">
            <!-- Post Magnific Overlay Single Component -->
            <div class="font-work flex items-center justify-between mb-8">
                <h5 class="text-base-content text-2xl font-bold">
                    Weekly Post
                </h5>
                <a href="/" class="btn btn-outline btn-secondary text-secondary-content/60 font-medium text-sm">
                    View All Post
                </a>
            </div>

            <!-- Post Overlay Landscape Large Component: Weekly Post -->
            <div class="w-full">
                <!-- Large overlay post start-->
                @if ($weeklyPosts->isNotEmpty())
                @foreach ($weeklyPosts as $index => $post)
                @if ($index == 0)
                <div class="card relative font-work max-h-[450px]">
                    <!-- Card Image  -->
                    <figure>
                        <img width="1216" height="450" alt="banner_image"
                            src="{{ $post->image() ?? 'https://placehold.it/800x450' }}"
                            class="rounded-xl w-full object-cover" />
                    </figure>
                    <div class="card-body p-2 md:p-10 absolute bottom-0 w-full z-20">
                        <div class="w-fit text-white px-2.5 py-1 bg-primary text-xs md:text-sm rounded-md mb-2 md:mb-4">
                            {{ $post->category->name ?? 'Uncategorized' }}
                        </div>
                        <h3>
                            <a href="{{ $post->link() }}"
                                class="text-neutral-content font-semibold text-xl line-clam-3 md:text-2xl lg:text-4xl leading-5 md:leading-10 hover:text-primary transition hover:duration-500">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <div class="mt-3 md:mt-6 flex items-center gap-5 text-neutral-content">
                            <div class=" flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-9 rounded-full">
                                        <img src="{{ $post->user->avatar() ?? 'https://placehold.it/100x100' }}"
                                            alt="avatar" />
                                    </div>
                                </div>
                                <h5>
                                    <a href="#"
                                        class="text-xs md:text-base font-medium hover:text-primary transition hover:duration-300">
                                        {{ $post->user->name }}
                                    </a>
                                </h5>
                            </div>
                            <p class="text-xs md:text-base">
                                {{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}
                            </p>
                        </div>
                    </div>

                    <!-- overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl">
                    </div>
                </div>
                <!-- Large overlay post end-->
                @else
                @if ($index == 1)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
                    <!-- Small post list card start-->
                    @endif

                    <div class="card">
                        <!-- card body section -->
                        <div class="card-body p-4 border border-base-content/10 rounded-xl w-fit">
                            <div class="flex items-center justify-center gap-4 font-work">
                                <figure class="flex-none">
                                    <img src="{{ $post->image() ?? 'https://placehold.it/110x90' }}"
                                        alt="PostCard_image" class="rounded-md" width="110px" height="190px" />
                                </figure>
                                <div>
                                    <h5>
                                        <a href="{{ $post->link() }}"
                                            class="font-work line-clam-2 font-semibold text-base text-base-content leading-5 hover:text-primary transition hover:duration-300 line-clam-2">
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

                    @if ($index == 2)
                    @endif
                    @endif
                    @endforeach
                    @endif
                </div>
                <!-- Small post list card end-->
            </div>


            <!-- Advertisement Component -->
            <div class="my-16 w-full">
                <div class="py-4 bg-base-content/10 text-base-content/60 text-center rounded-xl font-work">
                    <p class="text-sm">Advertisement</p>
                    <p class="text-xl font-semibold">You can place ads</p>
                    <p class="text-lg">750x100</p>
                </div>
            </div>

            <!-- Post Magnific Overlay Two Component: Lastest Post -->
            <div class="font-work flex items-center justify-between mb-8">
                <h5 class="text-base-content text-2xl font-bold">
                    Latest Post
                </h5>
                <a href="/" class="btn btn-outline btn-secondary text-secondary-content/60 font-medium text-sm">
                    View All Post
                </a>
            </div>
            <div class="w-full">
                <!-- Post overlay md card -->
                @if ($latestPosts->isNotEmpty())
                @foreach ($latestPosts as $index => $post)
                @if ($index == 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @endif

                    @if ($index <= 1) <div class="card relative font-work max-h-[406px]">
                        <!-- Card Image  -->
                        <figure>
                            <img width="1216" height="406px" alt="banner_image"
                                src="{{ $post->image() ?? 'https://placehold.it/800x406' }}"
                                class="rounded-xl w-full object-cover min-h-[406px]" />
                        </figure>
                        <div class="card-body p-2 md:p-6 absolute bottom-0 w-full z-20">
                            <div
                                class="w-fit text-white px-2.5 py-1 bg-primary text-xs md:text-sm rounded-md mb-2 md:mb-4">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </div>
                            <h3>
                                <a href="{{ $post->link() }}"
                                    class="text-neutral-content line-clam-3 font-semibold text-xl md:text-2xl hover:text-primary transition hover:duration-500">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <div class="mt-3 md:mt-6 flex items-center gap-5 text-neutral-content">
                                <div class=" flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="w-9 rounded-full">
                                            <img src="{{ $post->user->avatar() ?? 'https://placehold.it/100x100' }}"
                                                alt="avatar" />
                                        </div>
                                    </div>
                                    <h5>
                                        <a href="#"
                                            class="text-xs md:text-base font-medium hover:text-primary transition hover:duration-300">
                                            {{ $post->user->name }}
                                        </a>
                                    </h5>
                                </div>
                                <p class=" text-xs md:text-base">
                                    {{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}
                                </p>
                            </div>
                        </div>

                        <!-- overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-xl">
                        </div>
                </div>
                @endif

                @if ($index == 1)
            </div>
            @endif

            @if ($index == 2)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
                @endif

                @if ($index >= 2 && $index <= 4) <div class="card">

                    <div class="card-body p-4 border border-base-content/10 rounded-xl w-fit">
                        <div class="flex items-center justify-center gap-4 font-work">
                            <figure class="flex-none">
                                <img src="{{ $post->image() ?? 'https://placehold.it/110x90' }}" alt="PostCard_image"
                                    class="rounded-md" width="110px" height="190px" />
                            </figure>
                            <div>
                                <h5>
                                    <a href="{{ $post->link() }}"
                                        class="font-work line-clam-2 font-semibold text-base text-base-content leading-5 hover:text-primary transition hover:duration-300 line-clam-2">
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
            @endif

            @if ($index == 4)
        </div>
        @endif
        @endforeach
        @endif
    </div>
    </div>
    <!-- Advertisement Component -->
    <div class="my-16">
        <div class="py-4 bg-base-content/10 text-base-content/60 text-center rounded-xl font-work">
            <p class="text-sm">Advertisement</p>
            <p class="text-xl font-semibold">You can place ads</p>
            <p class="text-lg">750x100</p>
        </div>
    </div>
    </div>

    <!---------- Sidebar Component --------->
    <div class="col-span-12 lg:col-span-4 flex flex-col gap-5 justify-center order-last lg:order-none">
        <!------ Start sidebar popular post component ------>
        @include('theme::partials.home-post-latest-sidebar')

        <!------- Start sidebar category ------>
        @include('theme::partials.home-post-category-sidebar')
        <!------ Advertisement Vertical Component  ------>
        <div
            class="grid items-center justify-center bg-base-content/10 rounded-xl  min-h-[360px] max-w-[250px] w-full mx-auto">
            <div class="text-base-content/60 text-center font-work ">
                <p class="text-sm">Advertisement</p>
                <p class="text-xl font-semibold">You can place ads</p>
                <p class="text-lg">250x360</p>
            </div>
        </div>
    </div>
    </div>

</section>