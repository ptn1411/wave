@extends('theme::layouts.app')

@section('content')

<section class="py-4 bg-base-100 text-center font-work">
    <h1 class="text-base-content text-3xl font-semibold">Categories</h1>
    <ul class="menu menu-vertical mt-2 lg:menu-horizontal bg-base-200 rounded-box">

        @foreach ($categories as $cat)
        <li
            class="@if (isset($category) && isset($category->slug) && $category->slug == $cat->slug) {{ 'text-blue-700' }} @endif">
            <a class="hover:text-primary transition hover:duration-300 font-medium"
                href="{{ route('wave.blog.category', $cat->slug) }}">{{ $cat->name }}</a>
        </li>
        @endforeach
    </ul>
</section>
<section class="my-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($posts as $post)
        <article id="post-{{ $post->id }}" class="card w-fit p-4 border border-base-content/10 rounded-xl font-work"
            typeof="Article">
            <meta property="name" content="{{ $post->title }}">
            <meta property="author" typeof="Person" content="admin">
            <meta property="dateModified" content="{{ Carbon\Carbon::parse($post->updated_at)->toIso8601String() }}">
            <meta class="uk-margin-remove-adjacent" property="datePublished"
                content="{{ Carbon\Carbon::parse($post->created_at)->toIso8601String() }}">
            <figure>
                <a href="{{ $post->link() }}">
                    <img src="{{ $post->image() ?? 'https://placehold.it/360x240'}}" alt="email"
                        class="rounded-xl w-full" width="360px" height="240px" />
                </a>
            </figure>
            <div class="card-body py-6 px-2 font-medium">
                <span
                    class="btn no-animation hover:bg-primary hover:text-primary-content bg-primary/5 border-0 text-primary text-sm px-3 py-2 min-h-fit h-fit rounded-md w-fit capitalize">Technology</span>
                <h3>
                    <a href="{{ $post->link() }}"
                        class="text-base-content line-clam-3 hover:text-primary transition-all duration-300 ease-in-out font-semibold text-lg md:text-xl lg:text-2xl mt-2">The
                        {{ $post->title }}</a>
                </h3>
                <div class="mt-5 flex items-center gap-5 text-base-content/60">
                    <div class="flex items-center gap-3">
                        <div class="avatar">
                            <div class="w-9 rounded-full">
                                <img src="{{ $post->user->avatar() ?? 'https://placehold.it/100x100'}}" alt="avatar" />
                            </div>
                        </div>
                        <h5>
                            <a href="{{ '/@' . $post->user->username }}"
                                class="text-base font-medium hover:text-primary transition hover:duration-300">
                                {{ $post->user->name }}</a>
                        </h5>
                    </div>
                    <p class="text-base">{{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}</p>
                </div>
            </div>
        </article>
        @endforeach


    </div>
    <div class="flex items-center justify-center w-full mt-8">
        {{ $posts->links('theme::partials.pagination') }}

    </div>
</section>
@endsection