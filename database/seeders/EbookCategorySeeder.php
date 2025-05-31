<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EbookCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Filipiniana',
            'Fiction',
            'General Reference',
            'Encyclopedia',
            'Senior High School',
            'Undergraduate',
            'Graduate School'
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
