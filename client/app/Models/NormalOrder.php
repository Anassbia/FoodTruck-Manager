<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NormalOrder extends Model
{
    use HasFactory;

    protected $table = 'normal_orders';
    protected $primaryKey = 'id_NO';

    protected $fillable = [
        'date_order',
        'quantity',
        'paiement_type',
        'id_truck',
        
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'id_truck');
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
