<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbookLocation extends Model
{
    use HasFactory;

    protected $table = 'ebook_location';

    protected $fillable = ['location'];
}
