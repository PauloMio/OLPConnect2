<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'account';

    protected $fillable = [
        'firstname',
        'lastname',
        'credit',
        'loggedin',
        'loggedout',
        'schoolid',
        'birthdate',
        'status',
    ];

    protected $casts = [
        'credit' => 'decimal:2',
        'loggedin' => 'datetime',
        'loggedout' => 'datetime',
        'birthdate' => 'date',
    ];
}
