<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LadangSantara</title>
    @include('page.partials.css.style')
    @yield('css')

    <style>
        body {
            font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", Segoe UI Symbol, "Noto Color Emoji" !important;
        }
    </style>
</head>

<body>
    {{-- @include('page.partials.layouts.topbar') --}}
    @include('page.partials.layouts.header')

    <main id="main">
        @yield('content')
    </main>
    @include('page.partials.layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>
    @include('page.partials.js.style')
    @yield('js')
    @vite(['resources/js/app.js'])
</body>

</html>
