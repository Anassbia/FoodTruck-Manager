<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_employee';

    protected $fillable = ['first_name', 'last_name', 'email', 'cin', 'phone', 'image', 'birthday', 'salary', 'status', 'id_job'];

    public function job()
    {
        return $this->belongsTo(Job::class, 'id_job');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id_employee');
    }
}

