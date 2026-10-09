<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'commentaire',
        'date',
        'id_client',
        'id_menu',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
