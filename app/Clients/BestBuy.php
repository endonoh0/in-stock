<?php

namespace App\Clients;

use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class BestBuy implements Client
{
    public function CheckAvailability(Stock $stock): StockStatus
    {
        $results = Http::get('http://foo.test')->json();

        return new StockStatus(
            $results['available'],
            $results['price']
        );
    }
}
