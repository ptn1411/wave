@foreach($items as $menu_item)
<a href="{{ $menu_item->link() }}"
    class="link link-hover text-base text-base-content/70 hover:text-primary transition hover:duration-300 font-sans">{{ $menu_item->title }}</a>
@endforeach