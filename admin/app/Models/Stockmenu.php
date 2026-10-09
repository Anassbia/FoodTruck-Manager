<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stockmenu extends Model
{
    use HasFactory;

    protected $table = 'stockmenus';
    protected $primaryKey = 'id_stockmenu';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['id_stock', 'id_menuPers'];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }

    public function menuPer()
    {
        return $this->belongsTo(Formenuper::class, 'id_menuPers');
    }
}
