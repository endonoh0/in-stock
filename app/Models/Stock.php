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
            $results = $this->checkAvailability();
        }

        $this->update([
                'in_stock' => $results['available'],
                'price' => $results['price']
            ]);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function checkAvailability()
    {
        return Http::get('http://foo.test')->json();
    }
}
