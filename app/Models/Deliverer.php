<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverer extends Model
{
    use HasFactory;

    protected $table = 'deliverers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'address',
        'gender',
        'image_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
