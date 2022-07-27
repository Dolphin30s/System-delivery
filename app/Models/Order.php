<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_status',
        'number_shipped',
        'order_total',
        'currency_code',
        'address_id',
        'payment_id',
        'purchase_date'
    ];

    const ORDER_STATUS_NONE = 0;
    const ORDER_STATUS_HOLDING = 1;
    const ORDER_STATUS_PURCHASED = 2;
    const ORDER_STATUS_DELIVERING = 3;
    const ORDER_STATUS_REFUND = 4;
    const ORDER_STATUS_FINISHED = 5;
    const ORDER_STATUS_COMPLETED = 9;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    static public function getOrderStatusLabel($status): string
    {
        switch ($status){
            case Order::ORDER_STATUS_NONE:
                return 'None';
            case Order::ORDER_STATUS_HOLDING:
                return 'On hold';
            case Order::ORDER_STATUS_PURCHASED:
                return 'Purchased';
            case Order::ORDER_STATUS_DELIVERING:
                return 'Delivering';
            case Order::ORDER_STATUS_REFUND:
                return 'Refund';
            case Order::ORDER_STATUS_FINISHED:
                return 'Finished';
            case Order::ORDER_STATUS_COMPLETED:
                return 'Completed';
        }
        return 'None';
    }
}
