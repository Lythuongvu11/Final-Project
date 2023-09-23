<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'email' => 'newadmin@example.com',
            'password' => Hash::make('newadminpassword')
        ]);
        Admin::create([
            'email' => 'thuongvu@example.com',
            'password' => Hash::make('12112001')
        ]);
        Admin::create([
            'email' => 'thuongvu11@gmail.com',
            'password' => Hash::make('12112001')
        ]);
    }
}
