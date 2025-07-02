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
        'category',
        'edition',
        'publisher',
        'copyrightyear',
        'location',
        'class',
        'subject',
        'doi',
        'pdf',
        'coverage',
    ];

    public function favoredBy()
    {
        return $this->belongsToMany(Account::class, 'account_ebook_favorite')->withTimestamps();
    }

}
