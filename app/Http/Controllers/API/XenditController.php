<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\PaymentChannels;
use Xendit\VirtualAccounts;
use Xendit\Xendit;

class XenditController extends Controller
{
    public function __construct()
    {
        Xendit::setApiKey(config('xendit.secret_key'));
    }

    public function index()
    {
        $channels = VirtualAccounts::getVABanks();

        return $channels;
    }
}
