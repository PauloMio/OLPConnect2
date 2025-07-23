<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'), // Always hash passwords
            'status' => 'inactive',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'username' => 'boyzmaker',
            'email' => 'zyril.evangelista@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Always hash passwords
            'status' => 'inactive',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'username' => 'pjem',
            'email' => 'pjem@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Always hash passwords
            'status' => 'inactive',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'username' => 'Nik',
            'email' => 'defendingdemigod1975@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Always hash passwords
            'status' => 'inactive',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'username' => 'Olpcc College Library',
            'email' => 'olpcccollegelibrary@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Olpcc1949'), // Always hash passwords
            'status' => 'inactive',
            'remember_token' => Str::random(10),
        ]);
    }
}
