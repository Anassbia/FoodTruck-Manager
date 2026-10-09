<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuPers extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_menuPers';

    protected $fillable = [
        'name',
        'date_order',
        'paiement_type',
        'price',
        'quantity',
        'id_client',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
}

