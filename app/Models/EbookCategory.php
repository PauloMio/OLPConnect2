<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbookCategory extends Model
{
    use HasFactory;

    protected $table = 'ebook_category';

    protected $fillable = ['category'];
}
