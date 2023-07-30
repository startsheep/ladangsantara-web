<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    protected $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function index()
    {
        $data = [
            "stores" => $this->store->latest()->paginate(6)
        ];

        return view("page.user-page.index", $data);
    }

    public function store($slug)
    {
        $store = $this->store->whereSlug($slug)->first();

        if (!$store) {
            abort(404);
        }

        $data = [
            "store" => $store
        ];

        return view('page.user-page.store', $data);
    }
}
