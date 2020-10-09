<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\NowInStock;
use App\Notifications\StockUpdate;

class SendStockUpdateNotification
{
    /**
     * Handle the event.
     *
     * @param  NowInStock  $event
     * @return void
     */
    public function handle(NowInStock $event)
    {
        User::first()->notify(new StockUpdate($event->stock));
    }
}
