<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $researchCatgories = [
            "EMPLOYEE RESEARCH OUTPUT",
            "UNDERGRADUATE STUDENTS' OUTPUT",
            "MASTER'S RESEARCH OUTPUT",
            "DOCTORAL DISSERTION OUTPUT",
        ];

        foreach ($researchCatgories as $researchCatgory) {
            DB::table('research_category')->insert([
                'category' => $researchCatgory,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
