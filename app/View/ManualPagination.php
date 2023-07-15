<?php

namespace App\View;

class ManualPagination
{
    public static function render($paginator)
    {
        return view('components.pagination', compact('paginator'));
    }
}
