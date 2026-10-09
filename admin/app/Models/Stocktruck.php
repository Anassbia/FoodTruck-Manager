<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stocktruck extends Model
{
    use HasFactory;

    protected $table = 'stocktrucks';
    protected $primaryKey = 'id_stocktruck';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['id_truck', 'id_stock', 'quantity'];

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'id_truck');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }
}

