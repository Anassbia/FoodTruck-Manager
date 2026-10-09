<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_admin';


    protected $fillable = [
        'username', 'password', 'status', 'id_role', 'id_employee'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }
}

