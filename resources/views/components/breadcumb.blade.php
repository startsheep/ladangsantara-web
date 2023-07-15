<nav class="rounded-md text-sm sm:mt-0 mt-3">
    <ol class="list-reset flex">
        <li>
            <a href="{{ route('dashboard') }}"
                class=" text-blue-600/75 transition duration-150 ease-in-out hover:text-blue-600/100 focus:text-blue-600/100 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-blue-600/100">Dashboard</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        {{ $slot }}
    </ol>
</nav>
