<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_order';

    protected $fillable = [
        'date_order',
        'quantity',
        'paiement_type',
        'id_menu',
        'id_client',
        'id_truck'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
    public function truck()
    {
        return $this->belongsTo(Truck::class, 'id_truck');
    }
}