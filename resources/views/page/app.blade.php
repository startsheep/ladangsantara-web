<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ladangsantara</title>
    @include('page.partials.css.style')
    @yield('css')
</head>
<body>
    {{-- @include('page.partials.layouts.topbar') --}}
    @include('page.partials.layouts.header')

    <main id="main">
        @yield('content')
    </main>
    @include('page.partials.layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>
    @include('page.partials.js.style')
    @yield('js')
</body>
</html>
