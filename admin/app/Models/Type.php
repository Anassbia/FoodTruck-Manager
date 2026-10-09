<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';
    protected $primaryKey = 'id_type';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['type'];
}

