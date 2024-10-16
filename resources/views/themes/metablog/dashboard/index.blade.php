@extends('theme::layouts.app')


@section('content')

<div x-data="{ fullscreenModal: false, imageUrl: '' }" x-init="
    $watch('fullscreenModal', function(value){
            if(value === true){
                showModal()
                document.body.classList.add('overflow-hidden');
            }else{
                document.body.classList.remove('overflow-hidden');
                hiddenModal()
            }
        })
    " @keydown.escape="fullscreenModal=false">

    <div x-data="{
        tabSelected: 1,
        tabId: $id('tabs'),
        tabButtonClicked(tabButton){
            this.tabSelected = tabButton.id.replace(this.tabId + '-', '');
            this.tabRepositionMarker(tabButton);
        },
        tabRepositionMarker(tabButton){
            this.$refs.tabMarker.style.width=tabButton.offsetWidth + 'px';
            this.$refs.tabMarker.style.height=tabButton.offsetHeight + 'px';
            this.$refs.tabMarker.style.left=tabButton.offsetLeft + 'px';
        },
        tabContentActive(tabContent){
            return this.tabSelected == tabContent.id.replace(this.tabId + '-content-', '');
        },
        tabButtonActive(tabContent){
            const tabId = tabContent.id.split('-').slice(-1);
            return this.tabSelected == tabId;
        }
    }" x-init="tabRepositionMarker($refs.tabButtons.firstElementChild);" class="relative w-full max-w-full py-4">

        <div x-ref="tabButtons"
            class="relative inline-grid items-center justify-center w-full h-10 grid-cols-3 p-1 bg-base-100 border border-gray-100 rounded-lg select-none mb-6">
            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                :class="{ 'bg-gray-100 text-gray-700' : tabButtonActive($el) }"
                class="relative z-20 inline-flex items-center justify-center w-full h-8 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">Links</button>
            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                :class="{ 'bg-gray-100 text-gray-700' : tabButtonActive($el) }"
                class="relative z-20 inline-flex items-center justify-center w-full h-8 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">Collections</button>
            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                :class="{ 'bg-gray-100 text-gray-700' : tabButtonActive($el) }"
                class="relative z-20 inline-flex items-center justify-center w-full h-8 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">Tags</button>
            <div x-ref="tabMarker" class="absolute left-0 z-10 w-1/2 h-full duration-300 ease-out" x-cloak>
                <div class="w-full h-full bg-gray-100 rounded-md shadow-sm"></div>
            </div>
        </div>
        <div x-data
            x-init="$store.dataStore.fetchData(); $store.dataStore.fetchCollections(); $store.dataStore.fetchTags()"
            class="relative flex items-center justify-center w-full p-5 mt-2 text-xs text-gray-400 border rounded-md content border-gray-200/70">

            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative">
                <div class="flex w-full flex-col py-6 ">
                    <div class="mt-6">
                        <div id="list-links" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <template x-for="link in $store.dataStore.links" :key="link.id">
                                <div class="card bg-base-100 w-96 shadow-xl">
                                    <figure>
                                        <template x-if="link.preview">
                                            <img :src="`/storage/${link.preview}`" :alt="link.name" />
                                        </template>
                                        <template x-if="!link.preview">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-image mt-9">
                                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                                <circle cx="9" cy="9" r="2" />
                                                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                                            </svg>
                                        </template>
                                    </figure>
                                    <div class="card-body">
                                        <h2 class="card-title truncate w-full pr-9 text-primary text-sm"
                                            x-text="link.name"></h2>
                                        <a :href="link.url" target="_blank" :title="link.url" class="text-xs truncate"
                                            x-text="link.url"></a>

                                        <div class="card-actions justify-end">
                                            <!-- Bạn có thể thêm logic để hiển thị badge collection nếu cần -->
                                        </div>

                                        <div class="justify-start">
                                            <button @click="fullscreenModal=true; imageUrl=link.image"
                                                class="btn btn-outline btn-square">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="lucide lucide-fullscreen h-6 w-6">
                                                    <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                                                    <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                                                    <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                                                    <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                                                    <rect width="10" height="8" x="7" y="8" rx="1" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="mt-9 flex items-center justify-center">
                            <button @click="$store.dataStore.nextPage()"
                                :disabled="$store.dataStore.currentPage === $store.dataStore.totalPages"
                                class="btn btn-circle btn-outline flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-refresh-ccw h-6 w-6">
                                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                    <path d="M3 3v5h5" />
                                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                                    <path d="M16 16h5v5" />
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative" x-cloak>
                <div class="flex w-full flex-col py-6">
                    <div class="mt-6">
                        <div id="list-collections" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                            <template x-for="collection in $store.dataStore.collections" :key="collection.id">
                                <div class="card bg-base-100 w-96 shadow-xl">
                                    <div class="card-body">
                                        <h2 class="card-title truncate w-full pr-9 text-primary text-sm"
                                            x-text="collection.name"></h2>
                                        <div x-html="collection.description" class="text-xs"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="mt-9 flex items-center justify-center">
                            <button @click="$store.dataStore.nextCollectionsPage()"
                                :disabled="$store.dataStore.currentCollectionsPage === $store.dataStore.totalCollections"
                                class="btn btn-circle btn-outline flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-refresh-ccw h-6 w-6">
                                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                    <path d="M3 3v5h5" />
                                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                                    <path d="M16 16h5v5" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative" x-cloak>
                <div class="flex w-full flex-col py-6">
                    <div class="mt-6">
                        <div id="list-tags" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                            <template x-for="tag in $store.dataStore.tags" :key="tag.id">
                                <div class="card bg-base-100 w-96 shadow-xl">
                                    <div class="card-body">
                                        <h2 class="card-title truncate w-full pr-9 text-primary text-sm"
                                            x-text="tag.name"></h2>

                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="mt-9 flex items-center justify-center">
                            <button @click="$store.dataStore.nextTagsPage()"
                                :disabled="$store.dataStore.currentTagsPage === $store.dataStore.totalTags"
                                class="btn btn-circle btn-outline flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-refresh-ccw h-6 w-6">
                                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                    <path d="M3 3v5h5" />
                                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                                    <path d="M16 16h5v5" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <template x-teleport="body">
        <div x-show="fullscreenModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full" class="flex fixed inset-0 z-[99] w-screen h-screen bg-base-100">
            <button @click="fullscreenModal=false"
                class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-3 mr-3 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 lg:border-white/20 lg:bg-black/10 hover:lg:bg-black/30 text-neutral-600 lg:text-white hover:bg-neutral-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>Close</span>
            </button>

            <div class="flex items-center justify-center w-full h-full">
                <img :src="`/storage/${imageUrl}`" alt="Preview Image" class="max-w-full max-h-full object-contain" />

            </div>
        </div>
    </template>
</div>
<div x-data>
    <button @click="window.scrollTo({
        top: 0,
        behavior: 'smooth'
    })"
        class="scroll-to-top fixed bottom-16 right-5 w-12 h-12 bg-black text-white border-none rounded-full cursor-pointer z-1000 flex justify-center items-center shadow hover:bg-gray-600">
        ↑
    </button>
</div>
<div id="modalLink" x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
    :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto"
    style="top: 250px;left: 73px;position: fixed;z-index: 9999;">
    <button @click="modalOpen=true"
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-base-100 border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">New
        Link</button>
    <template x-teleport="body">
        <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
            x-cloak>
            <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false"
                class="absolute inset-0 w-full h-full bg-base-100 backdrop-blur-sm bg-opacity-70"></div>
            <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative w-full py-6 bg-base-100 border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                <div class="flex items-center justify-between pb-3">
                    <h3 class="text-lg font-semibold">New Link</h3>
                    <button @click="modalOpen=false"
                        class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="/links" method="post">
                    @csrf
                    <div class="relative w-auto pb-8">
                        <div class="p-6 pt-0 space-y-2">
                            <div class="space-y-1">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="nameLink">Name</label>
                                <input type="text" placeholder="Name" id="nameLink" name="name"
                                    class="flex w-full h-10 px-3 py-2 text-sm bg-base-100 border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            </div>
                            <div class="space-y-1">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="urlLink">URL</label>
                                <input type="text" placeholder="URL" id="urlLink" name="url"
                                    class="flex w-full h-10 px-3 py-2 text-sm bg-base-100 border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            </div>
                            <div class="space-y-1">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="descriptionLink">Description</label>

                                <textarea type="text" placeholder="Type your message here." id="descriptionLink"
                                    name="description"
                                    class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-base-100 border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>

                            </div>
                            <div class="space-y-1">

                                <select name="collection" id="collectionLink"
                                    class="select select-bordered w-full max-w-full">
                                    <option disabled selected>Collection</option>
                                    <template x-for="collection in $store.dataStore.collections" :key="collection.id">
                                        <option :value="collection.id" x-text="collection.name"></option>
                                    </template>
                                </select>
                            </div>

                            <div class="space-y-1">

                                <select name="tag" id="tagLink" class="select select-bordered w-full max-w-full">
                                    <option disabled selected>Tag</option>
                                    <template x-for="tag in $store.dataStore.tags" :key="tag.id">
                                        <option :value="tag.id" x-text="tag.name"></option>
                                    </template>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                        <button @click="modalOpen=false" type="button"
                            class="btn h-10 px-4 py-2 transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">Cancel</button>
                        <button @click="modalOpen=false" type="submit"
                            class="btn btn-success h-10 px-4 py-2 transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
<div id="modalCollection" x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
    :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto"
    style="top: 305px;left: 73px;position: fixed;z-index: 9999;">
    <button @click="modalOpen=true"
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-base-100 border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">New
        Collection</button>
    <template x-teleport="body">
        <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
            x-cloak>
            <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false"
                class="absolute inset-0 w-full h-full bg-base-100 backdrop-blur-sm bg-opacity-70"></div>
            <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative w-full py-6 bg-base-100 border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                <div class="flex items-center justify-between pb-3">
                    <h3 class="text-lg font-semibold">New Collection</h3>
                    <button @click="modalOpen=false"
                        class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="/collections" method="post">
                    @csrf
                    <div class="relative w-auto pb-8">
                        <div class="p-6 pt-0 space-y-2">
                            <div class="space-y-1">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="nameCollections">Name</label>
                                <input type="text" placeholder="Name" id="nameCollections" name="name"
                                    class="flex w-full h-10 px-3 py-2 text-sm bg-base-100 border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            </div>
                            <div class="space-y-1">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="descriptionCollections">Description</label>

                                <textarea type="text" placeholder="Type your message here." id="descriptionCollections"
                                    name="description"
                                    class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-base-100 border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>

                            </div>
                            <div class="space-y-1">

                                <select name="collection" id="collectionCollections"
                                    class="select select-bordered w-full max-w-full">
                                    <option disabled selected>Collection</option>
                                    <template x-for="collection in $store.dataStore.collections" :key="collection.id">
                                        <option :value="collection.id" x-text="collection.name"></option>
                                    </template>
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="isPublicCollections">Public</label>
                                <input id="isPublicCollections" name="isPublic" type="checkbox" checked="checked"
                                    class="checkbox checkbox-md ml-4" />

                            </div>
                        </div>


                    </div>
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                        <button @click="modalOpen=false" type="button"
                            class="btn h-10 px-4 py-2 transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">Cancel</button>
                        <button @click="modalOpen=false" type="submit"
                            class="btn btn-success h-10 px-4 py-2 transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
<div id="modalTag" x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
    :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto"
    style="top: 360px;left: 73px;position: fixed;z-index: 9999;">
    <button @click="modalOpen=true"
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-base-100 border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">New
        Tag</button>
    <template x-teleport="body">
        <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
            x-cloak>
            <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false"
                class="absolute inset-0 w-full h-full bg-base-100 backdrop-blur-sm bg-opacity-70"></div>
            <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative w-full py-6 bg-base-100 border shadow-lg px-7 border-neutral-200 sm:max-w-lg sm:rounded-lg">
                <div class="flex items-center justify-between pb-3">
                    <h3 class="text-lg font-semibold">New Tag</h3>
                    <button @click="modalOpen=false"
                        class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="/tags" method="post">
                    @csrf
                    <div class="relative w-auto pb-8">
                        <div class="p-6 pt-0 space-y-2">
                            <div class="space-y-1">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="nameCollections">Name</label>
                                <input type="text" placeholder="Name" id="nameCollections" name="name"
                                    class="flex w-full h-10 px-3 py-2 text-sm bg-base-100 border rounded-md peer border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            </div>
                        </div>

                    </div>
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                        <button @click="modalOpen=false" type="button"
                            class="btn h-10 px-4 py-2 transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">Cancel</button>
                        <button @click="modalOpen=false" type="submit"
                            class="btn btn-success h-10 px-4 py-2 transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection

@section('javascript')
<script>
    window.PTNToken = "{!! generateTokenForUser() !!}";

    document.addEventListener('alpine:init', () => {
        Alpine.store('dataStore',{
            links: [],
            collections: [],
            tags: [],
            currentPage: 1,
            totalPages: 1,
            totalTags: 1,
            totalCollections: 1,
            currentCollectionsPage: 1,
            currentTagsPage: 1,
            fetchData(page = 1) {
                const token = window.PTNToken; // Thay thế bằng token của bạn
                axios.get(`https://wave.test/api/links?page=${page}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    if (page === 1) {
                        this.links = response.data.data;
                    } else {
                        this.links = [...this.links, ...response.data.data];
                    }
                    this.totalPages = response.data.last_page;
                    this.currentPage = response.data.current_page;
                })
                .catch(error => console.error('Error fetching links:', error));
            },

            fetchCollections(page = 1) {
                const token = window.PTNToken; // Thay thế bằng token của bạn
                axios.get(`https://wave.test/api/collections?page=${page}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    if (page === 1) {
                        this.collections = response.data.data;
                    } else {
                        this.collections = [...this.collections, ...response.data.data];
                    }
                    this.totalCollections = response.data.last_page;
                    this.currentCollectionsPage = response.data.current_page;
                })
                .catch(error => console.error('Error fetching collections:', error));
            },
            fetchTags(page = 1) {
                const token = window.PTNToken; // Thay thế bằng token của bạn
                axios.get(`https://wave.test/api/tags?page=${page}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    if (page === 1) {
                        this.tags = response.data.data;
                    } else {
                        this.tags = [...this.tags, ...response.data.data];
                    }
                    this.totalTags = response.data.last_page;
                    this.currentTagsPage = response.data.current_page;
                })
                .catch(error => console.error('Error fetching collections:', error));
            },
            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.fetchData(this.currentPage + 1);
                }
            },

            prevPage() {
                if (this.currentPage > 1) {
                    this.fetchData(this.currentPage - 1);
                }
            },

            nextCollectionsPage() {
                if (this.currentCollectionsPage < this.totalCollections) {
                    this.fetchCollections(this.currentCollectionsPage + 1);
                }
            },

            prevCollectionsPage() {
                if (this.currentCollectionsPage > 1) {
                    this.fetchCollections(this.currentCollectionsPage - 1);
                }
            },
            nextTagsPage() {
                if (this.currentTagsPage < this.totalTags) {
                    this.fetchTags(this.currentTagsPage + 1);
                }
            }
        })
    })
    function showModal(){
                document.getElementById('modalTag').classList.add('hidden');
                document.getElementById('modalCollection').classList.add('hidden');
                document.getElementById('modalLink').classList.add('hidden');
    }
    function hiddenModal(){
                document.getElementById('modalTag').classList.remove('hidden');
                document.getElementById('modalCollection').classList.remove('hidden');
                document.getElementById('modalLink').classList.remove('hidden');
    }
</script>

@endsection