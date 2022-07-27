<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'tracking_number',
        'shipping_status',
        'longitude',
        'latitude',
        'history',
        'datetime',
    ];

    const SHIPPING_STATUS_PICKED = 0;
    const SHIPPING_STATUS_ROUTE = 1;
    const SHIPPING_STATUS_NEAR = 2;
    const SHIPPING_STATUS_DELIVERING = 3;

    static public function getShippingStatusLabel($status): string
    {
        switch ($status){
            case Delivery::SHIPPING_STATUS_PICKED:
                return 'PACKAGE HAS BEEN PICKED UP';
            case Delivery::SHIPPING_STATUS_ROUTE:
                return 'EN ROUTE';
            case Delivery::SHIPPING_STATUS_NEAR:
                return 'ALMOST AT THE DESTINATION';
            case Delivery::SHIPPING_STATUS_DELIVERING:
                return 'DELIVERED';
        }
        return '';
    }
}
