<?php

use Illuminate\Support\Str;

if (!function_exists('title')) {
    /**
     * @param  string  $value
     * @return string|null
     */
    function title($value)
    {
        return Str::remove(' ', ucwords(Str::of($value)->replace('_', ' ')));
    }
}

if (!function_exists('includeRouteFiles')) {

    /**
     * @param string $folder
     * @return void
     */
    function includeRouteFiles(string $folder)
    {
        // iterate thru the v1 folder recursively
        $dirIterator = new RecursiveDirectoryIterator($folder);

        /** @var RecursiveDirectoryIterator | \RecursiveIteratorIterator $it */
        $it = new RecursiveIteratorIterator($dirIterator);

        // require the file in each iteration
        while ($it->valid()) {
            if (
                !$it->isDot()
                && $it->isFile()
                && $it->isReadable()
                && $it->current()->getExtension() === 'php'
            ) {
                require $it->key();
                //                require $it->current()->getPathname();
            }
            $it->next();
        }
    }
}
