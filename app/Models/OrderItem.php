<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'title',
        'sku',
        'quantity_ordered',
        'quantity_shipped',
        'item_price',
        'currency_code',
        'image_url',
        'fee',
        'shipping_cost'
    ];

}
