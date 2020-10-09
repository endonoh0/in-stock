<?php

namespace App\Models;

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
        $status = $this->retailer
            ->client()
            ->checkAvailability($this);

        $this->update([
                'in_stock' => $status->available,
                'price' => $status->price
            ]);

        History::create([
            'price' => $this->price,
            'in_stock' => $this->in_stock,
            'product_id' => $this->product_id,
            'stock_id' => $this->id
        ]);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
