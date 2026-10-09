<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['job', 'id_service'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
}

