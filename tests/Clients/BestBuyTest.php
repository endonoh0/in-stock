<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Stock;
use App\Clients\BestBuy;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @group api
 */
class BestBuyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tracks_a_product()
    {
        $this->seed(RetailerWithProductSeeder::class);

        $stock = tap(Stock::first())->update([
            'sku' => '6428324',
            'url' => 'https://www.bestbuy.ca/en-ca/product/xbox-series-x-2020-1tb-console/14964951'
        ]);

        try {
            (new BestBuy())->checkAvailability($stock);
        } catch (Exception $e) {
            $this->fail('Failed to track the BestBuy API properly.');
        }

        $this->assertTrue(true);
    }
}
