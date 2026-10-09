<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_truck';


    protected $fillable = [
        'matricule', 'type', 'password', 'localisation', 'status'
    ];
}

