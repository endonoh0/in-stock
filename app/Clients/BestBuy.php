<?php

namespace App\Clients;

use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class BestBuy implements Client
{
    public function CheckAvailability(Stock $stock)
    {
        return Http::get('http://foo.test')->json();
    }
}
