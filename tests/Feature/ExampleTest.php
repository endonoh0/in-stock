<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Retailer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_checks_stock_for_products_at_retailers()
    {
        $switch = Product::create(['name' => 'Nintendo Switch']);

        $bestBuy = Retailer::create(['name' => 'Best Buy']);

        $this->assertFalse($switch->inStock());

        $stock = new Stock([
            'price' => 1000,
            'url' => 'http://foo.com',
            'sku' => '12345',
            'in_stock' => true
        ]);

        $bestBuy->addStock($switch, $stock);

        $this->assertTrue($switch->inStock());
    }
}
