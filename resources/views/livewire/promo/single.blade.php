<tr
    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
    <td class="whitespace-nowrap px-6 py-4 border-r font-medium">{{ $index }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $banner->user->name }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">
        <img src="{{ $banner->image_path }}" style="width: 180px; height: 90px;">
    </td>
    <td class="whitespace-nowrap px-6 py-4 border-r">
        <x-danger-button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-banner-deletion-{{ $banner->id }}')">Hapus
        </x-danger-button>
    </td>
</tr>
