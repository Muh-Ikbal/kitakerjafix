<section class="flex flex-col gap-10 py-5 bg-gradient-to-r from-cyan-500 to-blue-500">
    <div class="my-5 flex flex-col items-center">
        <h2 class="font-bold text-white text-center text-2xl md:text-4xl">Layanan</h2>
        <p class="text-white text-center p-3 md:max-w-[60%] mt-3">
            Temukan berbagai layanan berkualitas yang kami tawarkan untuk memenuhi kebutuhan Anda, mulai dari konsultasi
            hingga solusi terbaik yang dirancang untuk keberhasilan Anda.
        </p>
    </div>
    <div class="blog-slider mt-10 py-3 w-[100%]">
        <div class="blog-slider__wrp swiper-wrapper">
            @foreach ($services as $service)
                <div class="blog-slider__item swiper-slide">
                    <div class="blog-slider__img">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="Service Image">
                    </div>
                    <div class="blog-slider__content">
                        {{-- <span class="blog-slider__code">26 December 2019</span> --}}
                        <div class="blog-slider__title">{{ $service->name }}</div>
                        <div class="blog-slider__text ">{{ $service->description }} </div>
                        <a href="/layanan" class="blog-slider__button ">READ MORE</a>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="blog-slider__pagination mb-2"></div>
    </div>

</section>
