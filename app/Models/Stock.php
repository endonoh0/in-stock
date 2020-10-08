<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';
    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function track()
    {
        if ($this->retailer->name === 'Best Buy') {
            // Hit an API endpoint for the associated retailer
            // fetch the up-to-date details for the item
            $results = Http::get('http://foo.test')->json();

            // and then refresh the current stock record
            $this->update([
                'in_stock' => $results['available'],
                'price' => $results['price']
            ]);
        }
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
