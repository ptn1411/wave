<footer>
    <div class="bg-base-200 px-5 md:px-0 font-sans">
        <div class="container mx-auto">
            <div class="grid grid-cols-12 gap-5 py-16">
                <div class="col-span-12 lg:col-span-3">
                    <h5 class="text-lg font-semibold text-base-content font-sans">About</h5>
                    <p class="mt-3 text-base text-base-content/70 mb-6 font-sans">{{ theme('footer_description') }}</p>
                    <div>
                        <a href="mailto:{{ theme('contact_contact_email') }}"
                            class="font-semibold text-base-content text-base font-sans">
                            Email : <span
                                class="text-base-content/70 font-normal hover:text-primary hover:duration-300 transition font-sans">{{ theme('contact_contact_email') }}</span>
                        </a>
                    </div>
                    <div class="mt-1">
                        <a href="tel:{{ theme('contact_contact_phone') }}"
                            class="font-semibold text-base-content text-base font-sans">
                            Phone : <span
                                class="text-base-content/70 font-normal hover:text-primary hover:duration-300 transition font-sans">{{ theme('contact_contact_phone') }}</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-between lg:justify-center lg:gap-20 col-span-12 lg:col-span-5">
                    <div>
                        <h5 class="text-base-content text-lg font-semibold font-sans">Quick Link</h5>
                        <div class="flex flex-col gap-y-2 mt-6">
                            {{ menu('quick-link', 'quick_link_menu') }}
                        </div>
                    </div>
                    <div>
                        <h5 class="text-base-content text-lg font-semibold font-sans">Category</h5>
                        <div class="flex flex-col gap-y-2 mt-6">
                            @foreach($categories_footer as $category)
                            <a href="{{ route('wave.blog.category', $category->slug) }}"
                                class="link link-hover text-base text-base-content/70 hover:text-primary transition hover:duration-300 font-sans">
                                {{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4">
                    <div class="w-full">
                        <div class="bg-base-100 py-8 px-9 rounded-xl">
                            <p class="text-center text-xl font-semibold text-base-content">Weekly Newsletter</p>
                            <p class="mt-2 text-base text-center text-base-content/60">Get blog articles and offers via
                                email</p>
                            <form action="/contact" method="POST">
                                @csrf
                                <input class="hidden" type="text" name="name" value="Name" />
                                <input class="hidden" type="text" name="subject" value="Subject" />
                                <input class="hidden" type="text" name="message" value="Message">
                                <div class="relative flex items-center mt-7">
                                    <input placeholder="Your Email" type="email" name="email"
                                        class="px-4 py-3 border border-base-content/10 rounded-md w-full outline-none text-base-content placeholder:text-base bg-base-100" />

                                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="absolute right-4 text-base-content">
                                        <path fillRule="evenodd" clipRule="evenodd"
                                            d="M2.4375 1.375C1.91973 1.375 1.5 1.79473 1.5 2.3125V11.6875C1.5 12.2053 1.91973 12.625 2.4375 12.625H15.5625C16.0803 12.625 16.5 12.2053 16.5 11.6875V2.3125C16.5 1.79473 16.0803 1.375 15.5625 1.375H2.4375ZM0.25 2.3125C0.25 1.10438 1.22938 0.125 2.4375 0.125H15.5625C16.7706 0.125 17.75 1.10438 17.75 2.3125V11.6875C17.75 12.8956 16.7706 13.875 15.5625 13.875H2.4375C1.22938 13.875 0.25 12.8956 0.25 11.6875V2.3125Z"
                                            fill="currentColor" />
                                        <path fillRule="evenodd" clipRule="evenodd"
                                            d="M2.88165 2.86629C3.09357 2.59382 3.48625 2.54474 3.75871 2.75665L9 6.83321L14.2413 2.75665C14.5138 2.54474 14.9064 2.59382 15.1183 2.86629C15.3303 3.13875 15.2812 3.53143 15.0087 3.74335L9.38371 8.11835C9.15802 8.29389 8.84198 8.29389 8.61629 8.11835L2.99129 3.74335C2.71882 3.53143 2.66974 3.13875 2.88165 2.86629Z"
                                            fill="currentColor" />
                                    </svg>

                                </div>
                                <button
                                    class="btn btn-primary py-3 text-center font-medium w-full rounded-md mt-2 text-white text-base">Subscribe</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-col gap-4 md:gap-0 md:flex-row items-center justify-between py-8 bg-base-200 border-t border-base-content/10">
                <div class="flex items-center gap-2.5">
                    <a href="../">
                        @if (Voyager::image(theme('footer_logo')))
                        <img class="h-12" src="{{ Voyager::image(theme('footer_logo')) }}" alt="Company name">
                        @else
                        <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 208 206">
                            <defs />
                            <defs>
                                <linearGradient id="a" x1="100%" x2="0%" y1="45.596%" y2="45.596%">
                                    <stop offset="0%" stop-color="#5D63FB" />
                                    <stop offset="100%" stop-color="#0769FF" />
                                </linearGradient>
                                <linearGradient id="b" x1="50%" x2="50%" y1="0%" y2="100%">
                                    <stop offset="0%" stop-color="#39BEFF" />
                                    <stop offset="100%" stop-color="#0769FF" />
                                </linearGradient>
                                <linearGradient id="c" x1="0%" x2="99.521%" y1="50%" y2="50%">
                                    <stop offset="0%" stop-color="#38BCFF" />
                                    <stop offset="99.931%" stop-color="#91D8FF" />
                                </linearGradient>
                            </defs>
                            <g fill="none" fill-rule="evenodd">
                                <path fill="url(#a)"
                                    d="M185.302 38c14.734 18.317 22.742 41.087 22.698 64.545C208 159.68 161.43 206 103.986 206c-39.959-.01-76.38-22.79-93.702-58.605C-7.04 111.58-2.203 69.061 22.727 38a104.657 104.657 0 00-9.283 43.352c0 54.239 40.55 98.206 90.57 98.206 50.021 0 90.571-43.973 90.571-98.206A104.657 104.657 0 00185.302 38z" />
                                <path fill="url(#b)"
                                    d="M105.11 0A84.144 84.144 0 01152 14.21C119.312-.651 80.806 8.94 58.7 37.45c-22.105 28.51-22.105 68.58 0 97.09 22.106 28.51 60.612 38.101 93.3 23.239-30.384 20.26-70.158 18.753-98.954-3.75-28.797-22.504-40.24-61.021-28.47-95.829C36.346 23.392 68.723.002 105.127.006L105.11 0z" />
                                <path fill="url(#c)"
                                    d="M118.98 13c36.39-.004 66.531 28.98 68.875 66.234 2.343 37.253-23.915 69.971-60.006 74.766 29.604-8.654 48.403-38.434 43.99-69.685-4.413-31.25-30.678-54.333-61.459-54.014-30.78.32-56.584 23.944-60.38 55.28v-1.777C49.99 44.714 80.872 13.016 118.98 13z" />
                            </g>
                        </svg>
                        @endif

                    </a>
                    <div>
                        <h4 class="text-xl text-base-content font-sans">
                            {{ setting('site.title', 'Laravel Wave') }}
                        </h4>
                        <p class="mt-0.5 text-base-content/70 text-base font-sans"> &copy; {{ date('Y') }}
                            {{ setting('site.title', 'Laravel Wave') }}, Inc. All rights reserved.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 text-base-content/70">
                    <a href="../"
                        class="text-base border-r border-base-content/10 pr-4 hover:text-primary transition hover:duration-300 font-sans">Terms
                        of Use</a>
                    <a href="../"
                        class="text-base border-r border-base-content/10 pr-4 hover:text-primary transition hover:duration-300 font-sans">Privacy
                        Policy</a>
                    <a href="../" class="text-base hover:text-primary transition hover:duration-300 font-sans">Cookie
                        Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Scripts -->
@if(!auth()->guest() && auth()->user()->hasAnnouncements())
@include('theme::partials.announcements')
@endif
<script>
    function themeHandler() {
        return {
            theme: "",

            init() {
                // Lấy theme từ localStorage khi khởi tạo
                this.theme = localStorage.getItem("theme") || "light";
                document.documentElement.setAttribute("data-theme", this.theme);
            },

            setupTheme(newTheme) {
                // Nếu theme mới khác với theme hiện tại
                if (this.theme !== newTheme) {
                    // Cập nhật theme
                    this.theme = newTheme;
                    localStorage.setItem("theme", newTheme);
                    document.documentElement.setAttribute("data-theme", newTheme);
                }
            }
        };
    }
</script>
<script>
    function draggableButton() {
        return {
            position: { x: 100, y: 100 }, // Vị trí khởi đầu
            isDragging: false,
            startDrag(event) {
                this.isDragging = true;
                const offsetX = event.clientX - this.position.x;
                const offsetY = event.clientY - this.position.y;

                const moveHandler = (moveEvent) => {
                    if (this.isDragging) {
                        this.position.x = moveEvent.clientX - offsetX;
                        this.position.y = moveEvent.clientY - offsetY;
                    }
                };

                const stopHandler = () => {
                    this.isDragging = false;
                    localStorage.setItem('buttonPosition', JSON.stringify(this.position)); // Lưu vị trí vào local storage
                    document.removeEventListener('mousemove', moveHandler);
                    document.removeEventListener('mouseup', stopHandler);
                };

                document.addEventListener('mousemove', moveHandler);
                document.addEventListener('mouseup', stopHandler);
            },
            loadPosition() {
                const savedPosition = localStorage.getItem('buttonPosition');
                if (savedPosition) {
                    this.position = JSON.parse(savedPosition);
                }
            }
        };
    }
</script>
@yield('javascript')
<script src="{{ asset('themes/' . $theme->folder . '/js/app.js') }}"></script>
@yield('javascripttoast')
