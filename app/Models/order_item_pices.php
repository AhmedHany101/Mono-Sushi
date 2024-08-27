<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_item_pices extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'product_id',
        'order_item_id',
        'product_price',
        'product_pieces',
        'qty',
        'total',
        ];
        public function product()
        {
            return $this->belongsTo(dishes_data::class);
        }
}
