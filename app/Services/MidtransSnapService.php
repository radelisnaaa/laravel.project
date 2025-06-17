<?php

namespace App\Services;



use Midtrans\Snap;
use Midtrans\Config;

class MidtransSnapService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($params)
    {
        return Snap::createTransaction($params);
    }
}
