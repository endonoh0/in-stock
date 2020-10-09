<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductHistoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_records_each_time_stock_is_tracked()
    {
        $this->seed(RetailerWithProductSeeder::class);

        Http::fake(fn () => ['salePrice' => 9900, 'onlineAvailability' => true]);

        $this->assertEquals(0, History::count());

        Stock::first()->track();

        $this->assertEquals(1, History::count());
    }
}
