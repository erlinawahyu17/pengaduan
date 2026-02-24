<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin123'],
            
            [
                'name' => 'admin',
                'nis' => '001',
                'roles' => 'admin',
                'kelas' => 'admin',
                'password' => Hash::make('admin123'),
            ]
            );
    }
}
