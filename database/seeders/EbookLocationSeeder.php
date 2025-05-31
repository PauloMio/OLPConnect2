<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EbookLocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            'Filipiniana',
            'Fiction',
            'General Reference',
            'Encyclopedia',
            'Senior High School',
            'Undergraduate',
            'Graduate School'
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
