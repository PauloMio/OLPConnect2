<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramUserSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY',
            'BACHELOR OF SCIENCE IN COMPUTER ENGINEERING',
            'BACHELOR OF SCIENCE IN NURSING',
            'BACHELOR OF SCIENCE IN CRIMINOLOGY',
            'BACHELOR OF SCIENCE IN EDUCATION',
        ];

        foreach ($programs as $program) {
            DB::table('program_user')->insert([
                'program' => $program,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
