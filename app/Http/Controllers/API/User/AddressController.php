<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use MessageFixer;

    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function index()
    {
        $addresses = $this->address->where('user_id', auth()->user()->id)->get();
        return $this->customMessage('SUCCESS', 'data alamat berhasil diambil', JsonResponse::HTTP_OK, $addresses);
    }

    public function store(Request $request)
    {
    }
}
