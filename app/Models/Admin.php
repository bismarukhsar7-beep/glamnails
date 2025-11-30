<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['email', 'password'];
    public $timestamps = false; // Because you're not using created_at / updated_at
}
