<div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
        <div
            class="rounded-lg border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark p-6 text-gray-900 dark:text-gray-100">
            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-100">
                <i class="fas fa-users"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4 class="text-title-md font-bold text-black dark:text-white">

                    </h4>
                    <span class="text-sm font-medium">Total Pengguna</span>
                </div>

                <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                    {{ $totalUser }}
                </span>
            </div>
        </div>

        <div
            class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark p-6 text-gray-900 dark:text-gray-100">
            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-100">
                <i class="fas fa-money-bill-wave"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <span class="text-sm font-medium">Total Pendapatan</span>
                </div>

                <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                    Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div
            class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark p-6 text-gray-900 dark:text-gray-100">
            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-100">
                <i class="fas fa-shop"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <span class="text-sm font-medium">Total Mitra</span>
                </div>

                <span class="flex items-center gap-1 text-sm font-medium text-meta-3">
                    {{ $totalStore }}
                </span>
            </div>
        </div>

        <div
            class="rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark p-6 text-gray-900 dark:text-gray-100">
            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-100">
                <i class="fas fa-cube"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <span class="text-sm font-medium">Total Produk</span>
                </div>

                <span class="flex items-center gap-1 text-sm font-medium text-meta-5">
                    {{ $totalProduct }}
                </span>
            </div>
        </div>
    </div>
</div>
