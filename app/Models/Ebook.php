<?php

// app/Models/Ebook.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author',
        'coverage',
        'pdf',
        'status',
        'category',
        'edition',
        'publisher',
        'copyrightyear',
        'location',
    ];
}
