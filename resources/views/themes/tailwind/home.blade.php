@extends('theme::layouts.app')

@section('content')
    <div class="relative flex items-center w-full">

        <div class="relative z-20 px-8 mx-auto xl:px-5 max-w-7xl">

            <div class="flex flex-col items-center h-full pt-16 lg:flex-row">

                <div class="flex flex-col items-start w-full mb-16 md:items-center lg:pr-12 lg:items-start lg:w-1/2 lg:mb-0">

                    <h2 class="invisible text-sm font-semibold tracking-wide text-gray-700 uppercase transition-none duration-700 ease-out transform translate-y-12 opacity-0 sm:text-base lg:text-sm xl:text-base"
                        data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-y-12": "translate-y-0", "scale-110": "scale-100", "opacity-0": "opacity-100" }'>
                        {{ theme('home_headline') }}</h2>
                    <h1 class="invisible pb-2 mt-3 text-4xl font-extrabold leading-10 tracking-tight text-transparent transition-none duration-700 ease-out delay-150 transform translate-y-12 opacity-0 bg-clip-text bg-gradient-to-r from-blue-600 via-blue-500 to-purple-600 scale-10 md:my-5 sm:leading-none lg:text-5xl xl:text-6xl"
                        data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-y-12": "translate-y-0", "scale-110": "scale-100", "opacity-0": "opacity-100" }'>
                        {{ theme('home_subheadline') }}</h1>
                    <p class="invisible max-w-2xl mt-0 text-base text-left text-gray-600 transition-none duration-700 ease-out delay-300 transform translate-y-12 opacity-0 md:text-center lg:text-left sm:mt-2 md:mt-0 sm:text-base lg:text-lg xl:text-xl"
                        data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-y-12": "translate-y-0", "scale-110": "scale-100", "opacity-0": "opacity-100" }'>
                        {{ theme('home_description') }}</p>
                    <div class="invisible w-full mt-5 transition-none duration-700 ease-out transform translate-y-12 opacity-0 delay-450 sm:mt-8 sm:flex sm:justify-center lg:justify-start sm:w-auto"
                        data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-y-12": "translate-y-0", "opacity-0": "opacity-100" }'>
                        <div class="rounded-md">
                            <a href="{{ theme('home_cta_url') }}"
                                class="flex items-center justify-center w-full px-8 py-3 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-wave-500 hover:bg-wave-600 focus:outline-none focus:border-wave-600 focus:shadow-outline-indigo md:py-4 md:text-lg md:px-10">
                                {{ theme('home_cta') }}
                            </a>
                        </div>

                    </div>
                </div>

                <div class="flex w-full mb-16 lg:w-1/2 lg:mb-0">

                    <div class="relative invisible transition-none duration-1000 delay-100 transform translate-x-12 opacity-0"
                        data-replace='{ "transition-none": "transition-all", "invisible": "visible", "translate-x-12": "translate-y-0", "opacity-0": "opacity-100" }'>
                        <img src="{{ Voyager::image(theme('home_promo_image')) }}" class="w-full max-w-3xl sm:w-auto">
                    </div>

                </div>
            </div>
        </div>



    </div>



    <div class="relative mx-auto max-w-7xl my-10">
        <div class="rounded-lg overflow-hidden border border-neutral-200/60 bg-white text-neutral-700 shadow-sm w-[380px]">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2370&q=80"
                    class="w-full h-auto" />
            </div>
            <div class="p-7">
                <h2 class="mb-2 text-lg font-bold leading-none tracking-tight">Product Name</h2>
                <p class="mb-5 text-neutral-500">This card element can be used to display a product, post, or any other type
                    of data.</p>
                <button
                    class="inline-flex items-center justify-center w-full h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">View
                    Product</button>
            </div>
        </div>
        <section class="h-auto bg-white">
            <div class="px-10 py-24 mx-auto max-w-7xl">
                <div class="w-full mx-auto text-left md:text-center">
                    <h1
                        class="mb-6 text-5xl font-extrabold leading-none max-w-5xl mx-auto tracking-normal text-gray-900 sm:text-6xl md:text-6xl lg:text-7xl md:tracking-tight">
                        The <span
                            class="w-full text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-500 to-purple-500 lg:inline">Number
                            One Source</span> for<br class="lg:block hidden"> all your design needs. </h1>
                    <p class="px-0 mb-6 text-lg text-gray-600 md:text-xl lg:px-24"> Say hello to the number one source for
                        all your design needs. Drag and drop designs, edit designs, and modify the components to help tell
                        your story. </p>
                </div>
            </div>
        </section>
        <div x-tooltip="Your tooltip text here">
            hover me
        </div>

        <div class="grid gap-5 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-3">

            <!-- Loop Through Posts Here -->
            @foreach ($posts as $post)
                <article id="post-{{ $post->id }}" class="flex flex-col overflow-hidden rounded-lg shadow-lg"
                    typeof="Article">

                    <meta property="name" content="{{ $post->title }}">
                    <meta property="author" typeof="Person" content="admin">
                    <meta property="dateModified"
                        content="{{ Carbon\Carbon::parse($post->updated_at)->toIso8601String() }}">
                    <meta class="uk-margin-remove-adjacent" property="datePublished"
                        content="{{ Carbon\Carbon::parse($post->created_at)->toIso8601String() }}">

                    <div class="flex-shrink-0">
                        <a href="{{ $post->link() }}">
                            <img class="object-cover w-full h-48" src="{{ $post->image() }}" alt="">
                        </a>
                    </div>
                    <div class="relative flex flex-col justify-between flex-1 p-6 bg-white">
                        <div class="flex-1">
                            <a href="{{ $post->link() }}" class="block">
                                <h3 class="mt-2 text-xl font-semibold leading-7 text-gray-900">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            <a href="{{ $post->link() }}" class="block">
                                <p class="mt-3 text-base leading-6 text-gray-500">
                                    {{ substr(strip_tags($post->body), 0, 200) }}@if (strlen(strip_tags($post->body)) > 200)
                                        {{ '...' }}
                                    @endif
                                </p>
                            </a>
                        </div>
                        <p
                            class="relative self-start inline-block px-2 py-1 mt-4 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded">
                            <a href="{{ route('wave.blog.category', $post->category->slug) }}"
                                class="text-gray-700 hover:underline" rel="category">
                                {{ $post->category->name }}
                            </a>
                        </p>
                    </div>

                    <div class="flex items-center p-6 bg-gray-50">
                        <div class="flex-shrink-0">
                            <a href="#">
                                <img class="w-10 h-10 rounded-full" src="{{ $post->user->avatar() }}" alt="">
                            </a>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium leading-5 text-gray-900">
                                Written by <a href="#" class="hover:underline">{{ $post->user->name }}</a>
                            </p>
                            <div class="flex text-sm leading-5 text-gray-500">
                                on <time datetime="{{ Carbon\Carbon::parse($post->created_at)->toIso8601String() }}"
                                    class="ml-1">{{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}</time>
                            </div>
                        </div>
                    </div>

                </article>
            @endforeach
            <!-- End Post Loop Here -->

        </div>
    </div>
@endsection
