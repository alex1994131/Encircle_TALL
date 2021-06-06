<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Encircle') }}</title> -->
    <title>Encircle</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @livewireStyles

    <!-- Icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    @yield('style')
</head>

<body class="font-sans antialiased bg-blue-50">

    <div class="h-screen flex overflow-hidden bg-cool-gray-100">

        @livewire('offcanvas')

        @livewire('sidebar')

        <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">

            <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
                <!-- Page header -->
                @livewire('topbar')
                <!-- Page header end -->

                <div class="mt-8 bg-blue-50">
                    <!-- Page content -->
                    @yield('content')
                    <!-- Page content end -->
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    @yield('scripts_section')
    @stack('scripts')
    @stack('modals')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    @if (session()->has('success'))
    <script>
    const notyf = new Notyf({
        dismissible: true
    })
    notyf.success('{{ session('
        success ') }}')
    </script>
    @endif

    <script>
    /* Simple function to retrieve data url from file */
    function fileToDataUrl(event, callback) {
        if (!event.target.files.length) return

        let file = event.target.files[0],
            reader = new FileReader()

        reader.readAsDataURL(file)
        reader.onload = e => callback(e.target.result)
    }
    </script>
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>

</html>