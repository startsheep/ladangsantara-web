<div>
    <x-slot name="header">
        <div class="flex justify-between sm:items-center sm:flex-row flex-col">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Mitra ' . $store->name) }}
            </h2>

            <x-breadcumb>
                <li>
                    <a href="{{ route('web.store.index') }}"
                        class=" text-blue-600/75 transition duration-150 ease-in-out hover:text-blue-600/100 focus:text-blue-600/100 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-blue-600/100">Data
                        Mitra</a>
                </li>
                <li>
                    <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
                </li>
                <li class="text-neutral-500 dark:text-neutral-400 ">{{ $store->name }}</li>
            </x-breadcumb>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-wrap">
                        <div class="w-full max-w-full px-3 text-center shrink-0 lg:flex-0 lg:w-6/12 xl:w-5/12">
                            <img src="{{ $store->logo }}" class="w-full mx-auto rounded-xl shadow-soft-3xl"
                                alt="{{ $store->name }}">
                        </div>
                        <div class="w-full max-w-full px-3 mx-auto shrink-0 lg:flex-0 lg:w-5/12">
                            <h3 class="mt-6 dark:text-white lg:mt-0 text-3xl font-bold">{{ $store->name }}</h3>
                            <div>
                                <label
                                    class="inline-block mt-6 mb-2 font-bold text-sm text-slate-700 dark:text-white/80">
                                    Pemilik Toko</label>
                                <div class="mt-0 mb-4 text-slate-500">
                                    {{ $store->user->name }}
                                </div>
                            </div>
                            <div>
                                <label
                                    class="inline-block mt-2 mb-2 font-bold text-sm text-slate-700 dark:text-white/80">
                                    Alamat Toko</label>
                                <div class="mt-0 mb-4 text-slate-500">
                                    {{ $store->address }}
                                </div>
                            </div>
                            <div>
                                <label
                                    class="inline-block mt-2 mb-2 font-bold text-sm text-slate-700 dark:text-white/80">
                                    Deskripsi Toko</label>
                                <div class="mt-0 mb-4 text-slate-500">
                                    {{ $store->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12">
                        <h5 class="mb-5 dark:text-white font-semibold text-2xl">Produk Mitra</h5>
                        <div class="flex justify-between sm:items-center sm:flex-row flex-col">
                            <x-text-input wire:model="search" id="name" name="name" type="search"
                                placeholder="Pencarian" class="block sm:w-60 w-full max-w-full" />

                            @myPagination($products)
                        </div>
                        <div class="overflow-x-auto mt-5">
                            <table class="min-w-full border text-left text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 border-r">#</th>
                                        <th scope="col" class="px-6 py-4 border-r">Nama Produk</th>
                                        <th scope="col" class="px-6 py-4 border-r">Harga Produk</th>
                                        <th scope="col" class="px-6 py-4 border-r">Stok Produk</th>
                                        <th scope="col" class="px-6 py-4 border-r">Kategori Produk</th>
                                        <th scope="col" class="px-6 py-4 border-r">Jumlah Terjual</th>
                                        <th scope="col" class="px-6 py-4 border-r">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $index => $product)
                                        @livewire('product.single', ['product' => $product, 'index' => $index + $products->firstItem()], key($product->id))
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
    @foreach ($products as $product)
        <x-modal name="confirm-product-deletion-{{ $product->id }}" focusable>
            <form wire:submit.prevent="delete({{ $product->id }})">
                <div class="p-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Konfirmasi') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("apakah anda yakin menghapus data produk $product->name?") }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('TUTUP') }}
                        </x-secondary-button>
                        <x-danger-button class="ml-3">
                            {{ __('HAPUS') }}
                        </x-danger-button>
                    </div>
                </div>
            </form>
        </x-modal>
    @endforeach
</div>

@foreach ($products as $product)
    <x-modal name="confirm-user-deletion-{{ $product->id }}" focusable>
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Informasi Produk') }}
            </h2>

            <div class="flex sm:flex-row flex-col">
                <div class="w-full lg:w-5/12 sm:w-4/12 sm:pr-4 pr-0 mb-5">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                </div>
                <div class="w-full sm:pl-4 pl-0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border text-left text-sm font-light">
                            <tr>
                                <th class="border p-3 bg-blue-100">Nama Produk</th>
                                <td class="border p-3">{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th class="border p-3 bg-blue-100">Kategori Produk</th>
                                <td class="border p-3">{{ $product->category }}</td>
                            </tr>
                            <tr>
                                <th class="border p-3 bg-blue-100">Harga Produk</th>
                                <td class="border p-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="border p-3 bg-blue-100">Stok Produk</th>
                                <td class="border p-3">{{ $product->stock }}</td>
                            </tr>
                            <tr>
                                <th class="border p-3 bg-blue-100">Produk Terjual</th>
                                <td class="border p-3">{{ $product->purchases()->where('status', 3)->get()->count() }}
                                </td>
                            </tr>
                            <tr>
                                <th class="border p-3 bg-blue-100">Deskripsi Produk</th>
                                <td class="border p-3">{{ $product->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('TUTUP') }}
                </x-secondary-button>
            </div>
        </div>
    </x-modal>
@endforeach

@push('script')
@endpush
