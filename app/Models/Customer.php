<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'email',
        'firstname',
        'lastname',
        'phone',
        'mobile',
        'status'
    ];
}
