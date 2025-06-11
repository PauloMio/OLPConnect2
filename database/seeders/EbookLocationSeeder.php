<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EbookLocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            'Fiction',
            'General Reference',
            'Thesis',
            'Filipiniana',
            'Foreign',
        ];

        foreach ($locations as $location) {
            DB::table('ebook_location')->insert([
                'location' => $location,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
