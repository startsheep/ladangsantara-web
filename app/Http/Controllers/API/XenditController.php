<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use Illuminate\Http\Request;
use Xendit\Exceptions\ApiException;
use Xendit\PaymentChannels;
use Xendit\VirtualAccounts;
use Xendit\Xendit;

class XenditController extends Controller
{
    use MessageFixer;

    public function __construct()
    {
        Xendit::setApiKey(config('xendit.secret_key'));
    }

    public function VALists()
    {
        try {
            $banks = VirtualAccounts::getVABanks();

            return $banks;
        } catch (ApiException $th) {
            return $this->errorMessage($th->getMessage());
        }
    }
}
