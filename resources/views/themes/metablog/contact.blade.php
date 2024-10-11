@extends('theme::layouts.app')

@section('content')
<section class="mt-44 my-6">
    <div class="flex flex-col lg:grid lg:grid-cols-12 gap-8 items-start ">
        <!-- body section start  -->
        <div class="col-span-12 lg:col-span-8">
            <h2 class="text-3xl text-base-content font-bold font-work">{{ theme('contact_headline') }}</h2>
            <p class="mt-4 text-lg font-work text-base-content/70">{{ theme('contact_description') }}</p>
            <div class="mt-10 flex flex-col md:flex-row items-center gap-5">
                <div class="border border-base-content/10 rounded-xl p-6 font-work w-full">
                    <h6 class="text-base-content font-semibold text-2xl">Address</h6>
                    <p class="mt-4 text-lg text-base-content/70">
                        {!! theme('contact_address') !!}
                    </p>
                </div>
                <div class="border border-base-content/10 rounded-xl p-6 font-work w-full">
                    <h6 class="text-base-content font-semibold text-2xl">Contact</h6>
                    <p class="mt-4 text-lg text-base-content/70">
                        {!! theme('contact_contact') !!}
                    </p>
                </div>
            </div>

            <!-- contact form start  -->

            <div class="bg-base-200 rounded-xl p-8 md:p-12 mt-12">
                <h2 class="text-xl md:text-2xl leading-6 font-bold text-base-content mb-8">Leave a Message</h2>

                <form action="#" method="POST">
                    @csrf
                    <div class="flex flex-wrap md:flex-nowrap items-center gap-4 md:gap-5 mb-4">
                        <input
                            class="input w-full focus:outline-none text-sm md:text-base rounded-md border border-base-content border-opacity-10 px-3 md:px-4 py-2.5 md:py-3 placeholder:text-sm md:placeholder:text-base placeholder:text-base-content placeholder:text-opacity-40"
                            type="text" name="name" placeholder="Your Name" required />

                        <input
                            class="input w-full focus:outline-none text-sm md:text-base rounded-md border border-base-content border-opacity-10 px-3 md:px-4 py-2.5 md:py-3 placeholder:text-sm md:placeholder:text-base placeholder:text-base-content placeholder:text-opacity-40"
                            type="email" name="email" placeholder="Your Email" required />

                    </div>
                    <input
                        class="input w-full focus:outline-none text-sm md:text-base rounded-md border border-base-content border-opacity-10 px-3 md:px-4 py-2.5 md:py-3 placeholder:text-sm md:placeholder:text-base placeholder:text-base-content placeholder:text-opacity-40"
                        type="text" name="subject" placeholder="Subject" required />

                    <textarea name="message"
                        class="textarea w-full focus:outline-none text-sm md:text-base rounded-md border border-base-content border-opacity-10 px-3 md:px-4 py-2.5 md:py-3 placeholder:text-sm md:placeholder:text-base placeholder:text-base-content placeholder:text-opacity-40 mt-4"
                        placeholder="Write your message..." required></textarea>


                    <p class="text-sm md:text-base text-base-content text-opacity-70 mt-2">
                        We care about your data in our
                        <a href="/"
                            class="font-medium text-primary hover:underline transition hover:text-opacity-80 duration-300 ease-in-out ml-1">Privacy
                            Policy</a>
                    </p>
                    <button type="submit"
                        class="capitalize rounded-md bg-primary text-primary-content text-sm md:text-base font-medium px-5 py-3.5 mt-6 hover:bg-opacity-80 transition duration-300 ease-in-out">Send
                        Message</button>
                </form>
            </div>

            <!-- contact form end  -->

            <!-- advertisement section start  -->

            <div class="mt-12 flex items-center justify-center">
                <div class="w-11/12">
                    <div class="py-4 bg-base-content/10 text-base-content/60 text-center rounded-xl">
                        <p class="text-sm font-work">Advertisement</p>
                        <p class="text-xl font-semibold font-work">You can place ads</p>
                        <p class="text-lg font-work">750x100</p>
                    </div>
                </div>
            </div>
            <!-- advertisement section end  -->
        </div>

        <!-- body section end  -->

        <!-- sidebar section start  -->
        <div class="col-span-12 lg:col-span-4 flex flex-col gap-5 justify-center order-last lg:order-none">
            <!-- Latest post section start  -->
            @include('theme::partials.home-post-latest-sidebar')

            <!-- Latest post section end  -->

            <!-- banner section start  -->
            <section
                class="grid items-center justify-center bg-base-content/10 rounded-xl min-h-[360px] max-w-[250px] w-full mx-auto">
                <div class="text-base-content/60 text-center font-work">
                    <p class="text-sm">Advertisement</p>
                    <p class="text-xl font-semibold">You can place ads</p>
                    <p class="text-lg">250x360</p>
                </div>
            </section>
            <!-- banner section start  -->
        </div>
        <!-- sidebar section end  -->
    </div>
</section>

@endsection

@section('javascripttoast')
@if ($errors->has('name'))
<script>
    setTimeout(function() {
                popToast("warning", "{{ $errors->first('name') }}");
            }, 10);
</script>
@endif
@if ($errors->has('email'))
<script>
    setTimeout(function() {
                popToast("warning", "{{ $errors->first('email') }}");
            }, 10);
</script>
@endif
@if ($errors->has('subject'))
<script>
    setTimeout(function() {
                popToast("warning", "{{ $errors->first('subject') }}");
            }, 10);
</script>
@endif
@if ($errors->has('message'))
<script>
    setTimeout(function() {
                popToast("warning", "{{ $errors->first('message') }}");
            }, 10);
</script>
@endif
@endsection