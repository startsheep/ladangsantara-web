<div>
    <x-slot name="header">
        <div class="flex justify-between sm:items-center sm:flex-row flex-col">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Toko ' . $store->name) }}
            </h2>

            <x-breadcumb>
                <li>
                    <a href="{{ route('web.store.index') }}"
                        class=" text-blue-600/75 transition duration-150 ease-in-out hover:text-blue-600/100 focus:text-blue-600/100 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-blue-600/100">Data
                        Toko</a>
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
                            <div class="float-left border-0">
                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                <i class="fa-solid fa-star" aria-hidden="true"></i>
                                <i class="fa-solid fa-star-half-alt" aria-hidden="true"></i>
                            </div>
                            <br>
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
                        <h5 class="mb-5 dark:text-white font-semibold text-2xl">Produk Kami</h5>
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
</div>
