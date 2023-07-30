<tr
    class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
    <td class="whitespace-nowrap px-6 py-4 border-r font-medium">{{ $index }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $product->name }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $product->price }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $product->stock }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">{{ $product->category }}</td>
    <td class="whitespace-nowrap px-6 py-4 border-r">
        <span
            class="inline-block whitespace-nowrap rounded-[0.27rem] bg-blue-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-blue-700">
            {{ $product->purchases()->where('status', 3)->get()->count() }} Terjual
        </span>
    </td>
    <td class="whitespace-nowrap px-6 py-4 border-r">
        <x-primary-button url="{{ route('web.product.detail', $product->id) }}">Detail</x-primary-button>
        <x-danger-button class="btn-delete" data-url="{{ route('web.product.delete', $product->id) }}">Hapus
        </x-danger-button>
    </td>
</tr>
