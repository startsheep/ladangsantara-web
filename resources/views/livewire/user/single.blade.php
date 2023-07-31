<tr
    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
    <td class="whitespace-nowrap px-6 py-4 border-r font-medium">{{ $index }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $user->name }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $user->email }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">
        <x-primary-button url="{{ route('web.store.detail', $user->id) }}">Detail</x-primary-button>
        <x-danger-button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-store-deletion-{{ $user->id }}')">Hapus
        </x-danger-button>
    </td>
</tr>
