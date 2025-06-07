<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestLog extends Model
{
    protected $table = 'guestlog';

    protected $fillable = [
        'name',
        'school',
        'id_num',
        'course',
        'purpose',
    ];
}
