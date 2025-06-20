<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'CITE',
            'COA',
            'CBA',
            'COC',
            'CNM',
            'CHM',
            'CTED',
        ];

        foreach ($departments as $department) {
            DB::table('tbl_department')->insert([
                'department' => $department,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
