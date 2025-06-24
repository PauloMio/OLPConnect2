<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $table = 'research';

    protected $fillable = [
        'title',
        'author',
        'year',
        'category',
        'program',
        'Department',
        'accession_no',
    ];
}
