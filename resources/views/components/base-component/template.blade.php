<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kita Kerja IT</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/hero.png') }}">
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/slider.scss', 'resources/css/contact.css', 'resources/css/card.css','resources/css/modal.css','resources/js/modal.js'])
    @endif
</head>

<body class="bg-[#D6E4F0]">
    {{-- content --}}
    {{ $slot }}

    {{-- content --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.blog-slider', {
            spaceBetween: 30,
            effect: 'fade',
            loop: true,
            // mousewheel: {
            //     invert: true,
            // },
            // autoHeight: true,
            pagination: {
                el: '.blog-slider__pagination',
                clickable: true,
            }
        });
    </script>
    <script>
        const toggleMobile = document.getElementById('toggle-navbar');

        toggleMobile.addEventListener('click', (e) => {
            const currentSrc = e.target.src;

            if (currentSrc.includes("mobile-menu-icon.svg")) {
                e.target.src = "{{ asset('close.svg') }}";

            } else if (currentSrc.includes("close.svg")) {
                e.target.src = "{{ asset('mobile-menu-icon.svg') }}";
            }
            document.getElementById('mobile-navbar').classList.toggle('hidden')
        })
    </script>
</body>

</html>
