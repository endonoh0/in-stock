<?php

namespace App\Models;

use App\Clients\BestBuy;
use App\Clients\Target;
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
            $results = (new BestBuy())->checkAvailability($this);
        }

        if ($this->retailer->name === 'Target') {
            $results = (new Target())->checkAvailability($this);
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
}
