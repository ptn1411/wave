<div class="navbar grid grid-cols-12">
    <div class="col-span-3">
        <a href="/">
            @if (Voyager::image(theme('logo')))
            <img class="h-16" src="{{ Voyager::image(theme('logo')) }}" alt="Company name">
            @else
            <svg class="w-9 h-9" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 208 206">
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
    </div>
    <!--	Navbar section	-->
    {{ menu('guest-menu', 'guest_menu') }}

    <div class="flex items-center justify-end gap-6 col-span-9 xl:col-span-3">
        <!--   Search section	-->
        <div class="hidden md:block">
            <svg class="cursor-pointer w-5 h-5" width="20" height="20" viewBox="0 0 16 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.90906 2C5.93814 2 4.98903 2.28791 4.18174 2.82733C3.37444 3.36674 2.74524 4.13343 2.37368 5.03045C2.00213 5.92746 1.90491 6.91451 2.09433 7.86677C2.28375 8.81904 2.75129 9.69375 3.43783 10.3803C4.12438 11.0668 4.99909 11.5344 5.95135 11.7238C6.90362 11.9132 7.89067 11.816 8.78768 11.4444C9.6847 11.0729 10.4514 10.4437 10.9908 9.63639C11.5302 8.8291 11.8181 7.87998 11.8181 6.90906C11.818 5.60712 11.3008 4.35853 10.3802 3.43792C9.45959 2.51731 8.211 2.00008 6.90906 2Z"
                    stroke="currentColor" strokeWidth="1.5" strokeMiterlimit="10" />
                <path d="M10.5715 10.5716L14 14" stroke="currentColor" strokeWidth="1.5" strokeMiterlimit="10"
                    strokeLinecap="round" />
            </svg>
        </div>
        <!--	Theme Switch	-->
        <div class="flex-none">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-7 rounded-full">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                            class="w-7 h-7 text-base-content" height="1em" width="1em"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M441 336.2l-.06-.05c-9.93-9.18-22.78-11.34-32.16-12.92l-.69-.12c-9.05-1.49-10.48-2.5-14.58-6.17-2.44-2.17-5.35-5.65-5.35-9.94s2.91-7.77 5.34-9.94l30.28-26.87c25.92-22.91 40.2-53.66 40.2-86.59s-14.25-63.68-40.2-86.6c-35.89-31.59-85-49-138.37-49C223.72 48 162 71.37 116 112.11c-43.87 38.77-68 90.71-68 146.24s24.16 107.47 68 146.23c21.75 19.24 47.49 34.18 76.52 44.42a266.17 266.17 0 0086.87 15h1.81c61 0 119.09-20.57 159.39-56.4 9.7-8.56 15.15-20.83 15.34-34.56.21-14.17-5.37-27.95-14.93-36.84zM112 208a32 32 0 1132 32 32 32 0 01-32-32zm40 135a32 32 0 1132-32 32 32 0 01-32 32zm40-199a32 32 0 1132 32 32 32 0 01-32-32zm64 271a48 48 0 1148-48 48 48 0 01-48 48zm72-239a32 32 0 1132-32 32 32 0 01-32 32z">
                            </path>
                        </svg>
                    </div>
                </label>
                <ul tabindex="0" x-data="themeHandler()" x-init="init()"
                    class="grid dropdown-content p-3 shadow-lg mt-5 bg-base-200 rounded-lg w-52 max-h-80 overflow-x-auto">
                    <li @click="setupTheme('light')" data-theme='light'
                        class="capitalize w-full flex mb-2 rounded-md last-of-type:mb-0 justify-between items-center px-2 py-2  transition-all duration-300 cursor-pointer">
                        <span class="text-base-content flex items-center gap-2">
                            Light
                        </span>
                        <div class="flex flex-shrink-0 flex-wrap gap-1 h-full">
                            <div class="bg-primary w-2 rounded"></div>
                            <div class="bg-secondary w-2 rounded"></div>
                            <div class="bg-accent w-2 rounded"></div>
                            <div class="bg-neutral w-2 rounded"></div>
                        </div>
                    </li>
                    <li @click="setupTheme('dark')" data-theme="dark"
                        class="capitalize w-full flex mb-2 rounded-md last-of-type:mb-0 justify-between items-center px-2 py-2 transition-all duration-300 cursor-pointer">
                        <span class="text-base-content flex items-center gap-2">
                            Dark
                        </span>
                        <div class="flex flex-shrink-0 flex-wrap gap-1 h-full">
                            <div class="bg-primary w-2 rounded"></div>
                            <div class="bg-secondary w-2 rounded"></div>
                            <div class="bg-accent w-2 rounded"></div>
                            <div class="bg-neutral w-2 rounded"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex items-center justify-center gap-2 pb-2 border-b border-primary cursor-pointer">
            <svg class="w-5 h-5" stroke="currentColor" fill="currentColor" strokeWidth="0" viewBox="0 0 1024 1024"
                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-40 110.8V792H136V270.8l-27.6-21.5 39.3-50.5 42.8 33.3h643.1l42.8-33.3 39.3 50.5-27.7 21.5zM833.6 232L512 482 190.4 232l-42.8-33.3-39.3 50.5 27.6 21.5 341.6 265.6a55.99 55.99 0 0 0 68.7 0L888 270.8l27.6-21.5-39.3-50.5-42.7 33.2z">
                </path>
            </svg>
            <h6 class="text-base-content/80 text-base font-sans">
                SUBSCRIBE
            </h6>
        </div>

        <!--	Mobile Nav	-->
        <svg @click="sidebarOpen = true" class="cursor-pointer w-8 h-8 xl:hidden text-base-content" width="20"
            height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.33301 5H16.6663M3.33301 10H16.6663M3.33301 15H16.6663" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
</div>