<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('assets/images/ladangsantara.png') }}" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert/dist/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('assets/vendor/chartjs/dist/chart.umd.js') }}"></script>

    @stack('style')

    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>


    @stack('modal')

    @stack('script')

    @livewireScripts

    <script>
        document.addEventListener("showDeleteConfirmation", dataId => {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#1F2937',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteData', dataId);
                }
            })
        })
    </script>

    <script>
        document.addEventListener("showDeleteSuccess", function() {
            Swal.fire({
                title: "Selamat!",
                text: "Data berhasil dihapus",
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('reload')
                }
            })
        })
    </script>

    <script>
        window.addEventListener('toastr', event => {
            // toastr.options = {
            //     "closeButton": true,
            //     "progressBar": true,
            //     "onHidden": function() {
            location.reload()
            //     }
            // };

            // toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
        });
    </script>
</body>

</html>
