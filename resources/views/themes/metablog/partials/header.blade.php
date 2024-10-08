<header>
    <div class="container mx-auto font-work p-8 mb-6" x-data="{ sidebarOpen: false }">
        @if (auth()->guest())
        @include('theme::menus.guest')
        @include('theme::menus.guest-mobile')
        @else
        @include('theme::menus.authenticated')
        @include('theme::menus.authenticated-mobile')
        @endif
    </div>
</header>
