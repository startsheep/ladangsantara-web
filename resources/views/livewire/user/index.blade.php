<div>
    <x-slot name="header">
        <div class="flex justify-between sm:items-center sm:flex-row flex-col">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Data Pengguna') }}
            </h2>

            <x-breadcumb>
                <li class="text-neutral-500 dark:text-neutral-400 ">Data Pengguna</li>
            </x-breadcumb>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between sm:items-center sm:flex-row flex-col">
                        <x-text-input wire:model="search" id="name" name="name" type="search"
                            placeholder="Pencarian" class="block sm:w-60 w-full max-w-full" />

                        @myPagination($users)
                    </div>
                    <div class="overflow-x-auto mt-5">
                        <table class="min-w-full border text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4 border-r">#</th>
                                    <th scope="col" class="px-6 py-4 border-r">Nama Lengkap</th>
                                    <th scope="col" class="px-6 py-4 border-r">Email</th>
                                    <th scope="col" class="px-6 py-4 border-r">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $index => $user)
                                    @livewire('user.single', ['user' => $user, 'index' => $index + $users->firstItem()], key($user->id))
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($users as $user)
        <x-modal name="confirm-user-deletion-{{ $user->id }}" focusable>
            <form wire:submit.prevent="delete({{ $user->id }})">
                <div class="p-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Konfirmasi') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("apakah anda yakin menghapus data pengguna $user->name?") }}
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
