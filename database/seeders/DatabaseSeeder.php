<?php

namespace Database\Seeders;

use App\Models\EbookCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(UserSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(EbookCategorySeeder::class);
        $this->call(EbookLocationSeeder::class);
        $this->call(ProgramUserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ResearchCategory::class);
    }
}
