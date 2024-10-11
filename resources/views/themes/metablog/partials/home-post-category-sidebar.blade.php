<div class="rounded-xl border border-base-content border-opacity-10 p-8">
    <h4 class="text-xl font-semibold leading-6 text-base-content">
        Category
    </h4>
    <div class="pt-6">
        @foreach ($categories as $category)
        <div
            class="flex items-center justify-between last:border-none border-b border-base-content border-opacity-10 py-3.5">
            <a href="{{ route('wave.blog.category', $category->slug) }}"
                class="text-base font-medium text-base-content text-opacity-70 capitalize hover:text-primary transition ease-in-out duration-300">
                {{ $category->name }}
            </a>
            <span class="px-2 py-1 rounded-md bg-primary bg-opacity-5 text-primary text-xs font-medium">
                {{ $category->posts_count  }}
            </span>
        </div>
        @endforeach
    </div>
</div>
