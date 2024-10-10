<nav class="hidden xl:block col-span-6">

    <div class=" w-full flex items-center justify-center gap-10">
        @foreach($items as $menu_item)

        <a href="{{ $menu_item->link() }}"
            class="link link-hover text-base text-base-content/80 hover:text-primary transition hover:duration-300">
            {{ $menu_item->title }}
        </a>
        @endforeach

    </div>
</nav>