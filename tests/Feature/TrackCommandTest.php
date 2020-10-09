<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tracks_product_stock()
    {
        $this->seed(RetailerWithProductSeeder::class);

        $this->assertFalse(Product::first()->inStock());

        Http::fake(fn () => ['onlineAvailability' => true, 'salePrice' => 29900]);

        $this->artisan('track')->expectsOutput('All done!');

        $this->assertTrue(Product::first()->inStock());
    }
}
