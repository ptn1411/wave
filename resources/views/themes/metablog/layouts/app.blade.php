<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @if (isset($seo->title))
    <title>{{ $seo->title }}</title>
    @else
    <title>
        {{ setting('site.title', 'Laravel Wave') . ' - ' . setting('site.description', 'The Software as a Service Starter Kit built on Laravel & Voyager') }}
    </title>
    @endif

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!-- † -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">

    <link rel="icon" href="{{ Voyager::image(setting('site.favicon', '/wave/favicon.png')) }}" type="image/x-icon">

    {{-- Social Share Open Graph Meta Tags --}}
    @if (isset($seo->title) && isset($seo->description) && isset($seo->image))
    <meta property="og:title" content="{{ $seo->title }}">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:image" content="{{ $seo->image }}">
    <meta property="og:type" content="@if (isset($seo->type)) {{ $seo->type }}@else{{ 'article' }} @endif">
    <meta property="og:description" content="{{ $seo->description }}">
    <meta property="og:site_name" content="{{ setting('site.title') }}">

    <meta itemprop="name" content="{{ $seo->title }}">
    <meta itemprop="description" content="{{ $seo->description }}">
    <meta itemprop="image" content="{{ $seo->image }}">

    @if (isset($seo->image_w) && isset($seo->image_h))
    <meta property="og:image:width" content="{{ $seo->image_w }}">
    <meta property="og:image:height" content="{{ $seo->image_h }}">
    @endif
    @endif

    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">

    @if (isset($seo->description))
    <meta name="description" content="{{ $seo->description }}">
    @endif

    <!-- Styles -->
    <link href="{{ asset('themes/' . $theme->folder . '/css/app.css') }}" rel="stylesheet">
</head>

<body x-data="draggableButton()" x-init="loadPosition()">
    @include('theme::partials.header')

    <main class="container mx-auto px-5 sm:px-0 main-content">
        @yield('content')
    </main>

    @include('theme::partials.footer')

    @if (config('wave.dev_bar'))
    @include('theme::partials.dev_bar')


    @if (!auth()->guest())
    <div id="draggable-button" x-ref="button" x-on:mousedown="startDrag($event)"
        :style="{ left: position.x + 'px', top: position.y + 'px' }" class="relative draggable-button">
        <div x-data="{
        dropdownOpen: false
    }">
            <button class="btn btn-circle btn-active" @click="dropdownOpen=true"><svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-circle-chevron-down w-6 h-6">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m16 10-4 4-4-4" />
                </svg></button>

            <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="ease-out duration-200"
                x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0"
                class="absolute top-0 z-50 w-56 mt-12 -translate-x-1/2 left-1/2" x-cloak>
                <div
                    class="p-1 mt-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
                    <a href="#_" @click="menuBarOpen=false"
                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                        <span>New Tab</span>
                        <span
                            class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⌘T</span>
                    </a>
                    <a href="#_" @click="menuBarOpen=false"
                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                        <span>New Window</span>
                        <span
                            class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⌘N</span>
                    </a>
                    <div @click="menuBarOpen=false"
                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none"
                        data-disabled>
                        <span>New Private Window</span>
                        <span
                            class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⇧⌘N</span>
                    </div>
                    <div class="relative w-full group">
                        <div
                            class="flex cursor-default select-none items-center rounded px-2 hover:bg-neutral-100 py-1.5 outline-none">
                            <span>More Tools</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-4 h-4 ml-auto">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                        <div data-submenu
                            class="absolute top-0 right-0 invisible mr-1 duration-200 ease-out translate-x-full opacity-0 group-hover:mr-0 group-hover:visible group-hover:opacity-100">
                            <div
                                class="z-50 min-w-[8rem] overflow-hidden rounded-md border bg-white p-1 shadow-md animate-in slide-in-from-left-1 w-48">
                                <div @click="contextMenuOpen=false"
                                    class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                    Save Page As...<span
                                        class="ml-auto text-xs tracking-widest text-muted-foreground">⇧⌘S</span></div>
                                <div @click="contextMenuOpen=false"
                                    class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                    Create Shortcut...</div>
                                <div @click="contextMenuOpen=false"
                                    class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                    Name Window...</div>
                                <div class="h-px my-1 -mx-1 bg-neutral-200"></div>
                                <div @click="contextMenuOpen=false"
                                    class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                    Developer Tools</div>
                            </div>
                        </div>
                    </div>
                    <div class="h-px my-1 -mx-1 bg-neutral-200"></div>
                    <div x-data="{ showBookmarks: true }" @click="showBookmarks=!showBookmarks; contextMenuOpen=false"
                        class="relative flex cursor-default select-none items-center rounded py-1.5 pl-8 pr-2 hover:bg-neutral-100 outline-none data-[disabled]:opacity-50">
                        <span x-show="showBookmarks"
                            class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-4 h-4">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg></span>
                        <span>Show Bookmarks Bar</span>
                        <span
                            class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⌘⇧B</span>
                    </div>
                    <div x-data="{ showFullUrl: false }" @click="showFullUrl=!showFullUrl; contextMenuOpen=false"
                        class="relative flex cursor-default select-none items-center rounded py-1.5 pl-8 pr-2 hover:bg-neutral-100 outline-none data-[disabled]:opacity-50">
                        <span x-show="showFullUrl"
                            class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-4 h-4">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg></span>
                        <span>Show Full URLs</span>
                    </div>
                    <div class="h-px my-1 -mx-1 bg-neutral-200"></div>
                    <div x-data="{ contextMenuPeople: 'adam' }" class="relative">
                        <div @click="contextMenuPeople='adam'; contextMenuOpen=false"
                            class="relative flex cursor-default select-none items-center rounded py-1.5 pl-8 pr-2 hover:bg-neutral-100 outline-none data-[disabled]:opacity-50">
                            <span x-show="contextMenuPeople=='adam'"
                                class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-2 h-2 fill-current">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>
                            <span>Adam Wathan</span>
                        </div>
                        <div @click="contextMenuPeople='caleb'; contextMenuOpen=false"
                            class="relative flex cursor-default select-none items-center rounded py-1.5 pl-8 pr-2 hover:bg-neutral-100 outline-none data-[disabled]:opacity-50">
                            <span x-show="contextMenuPeople=='caleb'"
                                class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-2 h-2 fill-current">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>
                            <span>Caleb Porzio</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @endif
    @endif
    <!-- Full Screen Loader -->
    <div id="fullscreenLoader"
        class="fixed inset-0 top-0 left-0 z-50 flex-col items-center justify-center hidden w-full h-full bg-gray-900 opacity-50">
        <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
        <p id="fullscreenLoaderMessage" class="mt-4 text-sm font-medium text-white uppercase"></p>
    </div>
    <!-- End Full Loader -->
    @include('theme::partials.toast')

    @if (session('message'))
    <script>
        setTimeout(function() {
                popToast("{{ session('message_type') }}", "{{ session('message') }}");
            }, 10);
    </script>
    @endif
    @waveCheckout

</body>

</html>