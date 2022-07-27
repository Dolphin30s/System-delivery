<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'price',
        'delivery_fee',
        'total',
        'type',
        'data',
        'status'
    ];


    const STATUS_PENDING = 0;
    const STATUS_PAYED = 1;
    const STATUS_FAILED = 2;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
