<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'mdbusiness' }} | MD Business</title>
    <link rel="icon" type="image/png" href="/assets/favicon-32x32.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="font-['Poppins'] bg-gray-100 flex-1 justify-center ">

    <x-navigation.navbar :isSearchBar="$isSearchBar ?? true" />
    <main
        class="max-w-7xl mx-auto flex flex-col justify-center border bg-white transition-all duration-300 ease-in-out border-b border-gray-100 px-4 py-3 ">


        @yield('content')


    </main>
    <div
        class="max-w-7xl mx-auto flex flex-col justify-center border bg-white transition-all duration-300 ease-in-out border-b border-gray-100  py-3 ">
        <x-navigation.footer />
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('js/nav.js') }}"></script>
    <script src="{{ asset('js/hero.js') }}"></script>
    @stack('script')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>

</body>

</html>
