<div>
    <x-slot name="header">
        <div class="flex justify-between sm:items-center sm:flex-row flex-col">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Pengguna') }}
            </h2>

            <x-breadcumb>
                <li>
                    <a href="{{ route('web.user.index') }}"
                        class=" text-blue-600/75 transition duration-150 ease-in-out hover:text-blue-600/100 focus:text-blue-600/100 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-blue-600/100">Pengguna</a>
                </li>
                <li>
                    <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
                </li>
                <li class="text-neutral-500 dark:text-neutral-400 ">Detail Pengguna</li>
            </x-breadcumb>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap">
                <div class="w-full max-w-full px-3 text-center shrink-0 lg:flex-0 lg:w-5/12 xl:w-4/12">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="text-center font-bold text-2xl">{{ $user->name }}</h2>
                            <h3 class="text-center">{{ $user->email }}</h3>
                            <hr class="my-5">
                            <div class="text-left">
                                <p class="font-bold"><span class="fas fa-location-dot"></span>&nbsp; Alamat</p>
                                <p>{{ $user->address()->isActive()->first()->address }}, desa
                                    {{ $user->address()->isActive()->first()->village['nama'] }}, kec.
                                    {{ $user->address()->isActive()->first()->district['nama'] }}, kab.
                                    {{ $user->address()->isActive()->first()->regency['nama'] }},
                                    {{ $user->address()->isActive()->first()->province['nama'] }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 text-center shrink-0 lg:flex-0 lg:w-7/12 xl:w-8/12">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div>
                                <h2 class="text-center font-bold text-xl">Data Pesanan</h2>
                                <hr class="my-4">
                            </div>
                            <div class="flex justify-between sm:items-center sm:flex-row flex-col">
                                <x-text-input wire:model="search" id="name" name="name" type="search"
                                    placeholder="Pencarian" class="block sm:w-60 w-full max-w-full" />
                                @myPagination($user->orders()->paginate(10))
                            </div>
                            <div class="overflow-x-auto mt-5">
                                <table class="min-w-full border text-left text-sm font-light">
                                    <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4 border-r">#</th>
                                            <th scope="col" class="px-6 py-4 border-r">Kode Transaksi</th>
                                            <th scope="col" class="px-6 py-4 border-r">Status Pembayaran</th>
                                            <th scope="col" class="px-6 py-4 border-r">Jumlah Pembayaran</th>
                                            <th scope="col" class="px-6 py-4 border-r">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders = $user->orders()->paginate(10) as $index => $order)
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-4 border-r font-medium">
                                                    {{ $index + $orders->firstItem() }}</td>
                                                <td class="whitespace-nowrap px-6 py-4 border-r">
                                                    {{ $order->external_id }}</td>
                                                <td class="whitespace-nowrap px-6 py-4 border-r">{{ $order->status }}
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4 border-r">Rp
                                                    {{ number_format($order->amount_purchase, 0, ',', '.') }}</td>
                                                <td class="whitespace-nowrap px-6 py-4 border-r">
                                                    <x-primary-button x-data=""
                                                        x-on:click.prevent="$dispatch('open-modal', 'detail-order--{{ $order->id }}')">
                                                        Detail</x-primary-button>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($orders = $user->orders()->paginate(10) as $order)
    <x-modal name="detail-order--{{ $order->id }}" focusable>
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Informasi Pesanan') }}
            </h2>

            <div class="overflow-x-auto mt-5">
                <table class="min-w-full border text-left text-sm font-light">
                    <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4 border-r">#</th>
                            <th scope="col" class="px-6 py-4 border-r">Nama Produk</th>
                            <th scope="col" class="px-6 py-4 border-r">Jumlah Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->purchases as $index => $purchase)
                            <tr>
                                <td class="whitespace-nowrap px-6 py-4 border-r font-medium">
                                    {{ $index + 1 }}</td>
                                <td class="whitespace-nowrap px-6 py-4 border-r">
                                    {{ $purchase->product->name }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 border-r">
                                    {{ $purchase->qty }}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('TUTUP') }}
                </x-secondary-button>
            </div>
        </div>

    </x-modal>
@endforeach
