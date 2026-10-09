<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Catstock extends Model
{
    use HasFactory;

    protected $table = 'catstocks';
    protected $primaryKey = 'id_catstock';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['id_stock', 'id_categorie'];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }
}
