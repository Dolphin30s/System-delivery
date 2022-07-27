<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'gender',
        'birth_date',
        'image_url',
        'picid',
        'cc2',
        'valid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    const USER_ROLE_CUSTOMER = 'customer';
    const USER_ROLE_DELIVERER = 'deliverer';
    const USER_ROLE_ADMIN = 'admin';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isAdmin(){
        return $this->role == self::USER_ROLE_ADMIN;
    }

    public function isDeliverer(){
        return $this->role == self::USER_ROLE_DELIVERER;
    }

    public function isCustomer(){
        return ($this->role != self::USER_ROLE_ADMIN) && ($this->role != self::USER_ROLE_DELIVERER);
    }
}
