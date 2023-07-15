@props(['bgClass' => 'blue'])

<div class="rounded-lg bg-{{ $bgClass }}-100 px-6 py-5 text-base text-{{ $bgClass }}-800" role="alert">
    {{ $slot }}
</div>
