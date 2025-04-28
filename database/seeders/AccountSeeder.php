<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([
            'firstname' => 'Zyril',
            'lastname' => 'Evangelista',
            'credit' => 1500.50,
            'loggedin' => Carbon::now()->subHours(2),
            'loggedout' => Carbon::now(),
            'schoolid' => '201080009',
            'birthdate' => '2001-12-30',
            'status' => 'inactive',
        ]);

        // Add more fake entries if you want:
        Account::create([
            'firstname' => 'pj',
            'lastname' => 'em',
            'credit' => 2500.50,
            'loggedin' => Carbon::now()->subHours(2),
            'loggedout' => Carbon::now(),
            'schoolid' => '123',
            'birthdate' => '2001-05-27',
            'status' => 'inactive',
        ]);

        Account::create([
            'firstname' => 'ben',
            'lastname' => 'ram',
            'credit' => 1500.50,
            'loggedin' => Carbon::now()->subHours(2),
            'loggedout' => Carbon::now(),
            'schoolid' => '201080005',
            'birthdate' => '2001-10-10',
            'status' => 'inactive',
        ]);
    }
}
