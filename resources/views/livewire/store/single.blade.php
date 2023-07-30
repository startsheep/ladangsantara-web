<tr
    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
    <td class="whitespace-nowrap px-6 py-4 border-r font-medium">{{ $index }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $store->name }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $store->user->name }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $store->address }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">
        <x-primary-button url="{{ route('web.store.detail', $store->id) }}">Detail</x-primary-button>
        <x-danger-button wire:click="confirmDelete({{ $store->id }})">Hapus</x-danger-button>
    </td>
</tr>
