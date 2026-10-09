<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id_client';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birthday',
        'phone',
        'points',
    ];

    protected $hidden = ['password'];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class, 'id_client');
    }

    public function menuPers()
    {
        return $this->hasMany(MenuPers::class, 'id_client');
    }
}

