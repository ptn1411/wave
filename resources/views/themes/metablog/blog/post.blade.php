@extends('theme::layouts.app')

@section('content')
<div class="text-sm breadcrumbs py-8">
    <ul>
        <li>
            <a href="{{ route('wave.home') }}" class="text-base-content">Home</a>
        </li>
        <li>
            <a href="{{ route('wave.blog.category', $post->category->slug) }}"
                class="text-base-content">{{ $post->category->name }}</a>
        </li>
        <li class="text-base-content/60">{{ $post->title }}</li>
    </ul>
</div>
<article x-data="viewTracker()" x-init="init()" id="post-{{ $post->id }}"
    class="flex flex-col lg:grid lg:grid-cols-12 gap-8 items-start">

    <meta property="name" content="{{ $post->title }}">
    <meta property="author" typeof="Person" content="admin">
    <meta property="dateModified" content="{{ Carbon\Carbon::parse($post->updated_at)->toIso8601String() }}">
    <meta class="uk-margin-remove-adjacent" property="datePublished"
        content="{{ Carbon\Carbon::parse($post->created_at)->toIso8601String() }}">
    <div class="col-span-12 lg:col-span-8">
        <div class="py-5">
            <div class="w-fit text-white px-2.5 py-1 bg-primary text-xs md:text-sm rounded-md mb-2 md:mb-4">
                {{ $post->category->name }}
            </div>
            <h3 class="text-base-content font-semibold text-xl md:text-2xl lg:text-4xl leading-7 md:leading-10">
                {{ $post->title }}</h3>
            <div class="mt-3 md:mt-6 flex items-center gap-5 text-base-content/60">
                <div class="flex items-center gap-3">
                    <div class="avatar">
                        <div class="w-9 rounded-full">
                            <img src="{{ $post->user->avatar() ?? 'https://placehold.it/100x100' }}" alt="avatar" />
                        </div>
                    </div>
                    <a href="{{ '/@' . $post->user->username }}"
                        class="text-xs md:text-base font-medium hover:text-primary transition hover:duration-300">{{ $post->user->name }}</a>
                </div>
                <p class="text-xs md:text-base">{{ Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}
                </p>
            </div>
        </div>
        <div class="mt-8">
            <img width="800" height="462" class="rounded-xl w-full"
                src="{{ $post->image() ?? 'https://placehold.it/800x462' }}" alt="{{ $post->title }}"
                srcset="{{ $post->image() }}">

        </div>
        <div class="flex items-center justify-center my-8 font-work">
            <div class="py-4 bg-base-content/10 text-base-content/60 text-center rounded-xl w-11/12">
                <p class="text-sm">Advertisement</p>
                <h6 class="text-xl font-semibold">You can place ads</h6>
                <p class="text-lg">750x100</p>
            </div>
        </div>
        <div class="prose max-w-4xl mx-auto font-serif">
            {!! $post->body !!}
        </div>
        <div class="flex items-center justify-center my-8 font-work">
            <div class="py-4 bg-base-content/10 text-base-content/60 text-center rounded-xl w-11/12">
                <p class="text-sm">Advertisement</p>
                <h6 class="text-xl font-semibold">You can place ads</h6>
                <p class="text-lg">750x100</p>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-4 flex flex-col gap-5 justify-center order-last lg:order-none">
        @include('theme::partials.home-post-latest-sidebar')
        @include('theme::partials.home-post-category-sidebar')
        <div
            class="grid items-center justify-center bg-base-content/10 rounded-xl min-h-[360px] max-w-[250px] w-full mx-auto">
            <div class="text-base-content/60 text-center font-work">
                <p class="text-sm">Advertisement</p>
                <p class="text-xl font-semibold">You can place ads</p>
                <p class="text-lg">250x360</p>
            </div>
        </div>
    </div>
</article>
<button
    class="scroll-to-top fixed bottom-16 right-5 w-12 h-12 bg-black text-white border-none rounded-full cursor-pointer z-1000 flex justify-center items-center shadow hover:bg-gray-600">
    ↑
</button>
<div class="max-w-4xl mx-auto mt-6 pb-20">
    <div id="disqus_thread" class="disqus-comments bg-base-100 p-4 rounded shadow-md"></div>
    <script>
        /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */

        //     var disqus_config = function () {
        //     this.page.url = "{{ url()->current() }}";  // URL của trang hiện tại
        //     this.page.identifier = '{{ request()->path() }}'; // Identifier duy nhất cho bài viết
        // };
            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document,
                    s = d.createElement('script');
                s.src = 'https://bug-edu-vn.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
</div>
@endsection
@section('javascript')
<script>
    function viewTracker() {
            return {
                postId: {{ $post->id }}, // Thay đổi thành ID của bài viết cần tăng lượt xem
                viewApiCalled: false, // Biến để theo dõi xem API đã được gọi chưa
                stayDuration: 5000, // 5 giây

                init() {
                    let scrollTimeout; // Biến để lưu timeout khi cuộn

                    window.addEventListener('scroll', () => {
                        // Kiểm tra xem người dùng đã cuộn đến gần cuối trang chưa
                        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {
                            clearTimeout(scrollTimeout); // Xóa timeout trước đó

                            scrollTimeout = setTimeout(() => {
                                this.incrementPostView();
                            }, this.stayDuration);
                        }
                    });
                },

                incrementPostView() {
                    if (!this.viewApiCalled) {
                        axios.post(`/api/views/${this.postId}/increment-view`, {
                                // Dữ liệu gửi đi nếu cần thiết
                            }, {
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content')
                                }
                            })
                            .then(response => {
                                console.log(response.data); // Xử lý dữ liệu trả về
                                this.viewApiCalled = true; // Đánh dấu là API đã được gọi
                            })
                            .catch(error => console.error('Error:', error));
                    }
                }
            };
        }
</script>
@endsection