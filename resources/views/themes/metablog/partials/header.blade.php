<header id="header" class="fixed top-0 left-0 right-0 z-50 bg-base-100 shadow">
    <div class="container mx-auto font-work mb-2" x-data="{ sidebarOpen: false }">
        @if (auth()->guest())
        @include('theme::menus.guest')
        @include('theme::menus.guest-mobile')
        @else
        @include('theme::menus.authenticated')
        @include('theme::menus.authenticated-mobile')
        @endif
    </div>
</header>