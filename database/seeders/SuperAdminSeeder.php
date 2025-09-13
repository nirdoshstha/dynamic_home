<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' =>'Allstar Technology',
            'username'=>'allstar',
            'email' =>'allstarsms45@gmail.com',
            'password' =>Hash::make('allstar123'),
            'user_role' =>'2',
            'is_banned' =>'0'
        ]);
    }
}
