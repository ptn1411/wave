@foreach($items as $menu_item)

<a href="{{ $menu_item->link() }}"
    class="link link-hover text-base text-base-content/80 hover:text-primary transition hover:duration-300 font-worklink link-hover text-base text-base-content/80 hover:text-primary transition hover:duration-300 font-work">
    {{ $menu_item->title }}
</a>
@endforeach