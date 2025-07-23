<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EbookCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Generalities',
            'Philosophy & Psychology',
            'Religion',
            'Social Sciences',
            'Language',
            'Natural Sciences',
            'Applied Sciences',
            'Arts',
            'Literature & Rhetorics',
            'History & Geography',
            'Senior Highschool Books',
            'Fiction',
            'Graduate',
        ];

        foreach ($categories as $category) {
            DB::table('ebook_category')->insert([
                'category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
