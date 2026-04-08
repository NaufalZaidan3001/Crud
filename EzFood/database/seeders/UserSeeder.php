<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'zaidann50@gmail.com',
        //     'password' => Hash::make('rahasia123'), // Use a secure password in production
        //     'role' => 'admin', // Assuming you have a role column to differentiate admin users
        //     'phone' => '1234567890', // Add phone number if required
        // ]);

        // $restaurantOwner = User::create([
        //     'name' => 'Budi Santoso',
        //     'email' => 'restaurant@example.com',
        //     'password' => Hash::make('rahasia123'),
        //     'role' => 'restaurant',
        //     'phone' => '0987654321',
        // ]);

        // $restaurantOwner->restaurant()->create([
        //     'restaurant_name' => 'Rumah Makan Sederhana',
        //     'description' => 'Menyajikan masakan tradisional dengan cita rasa yang autentik.',
        //     'address' => 'Jl. Sudirman Alamat No. 123',
        //     'phone' => '0987654321',
        //     // status will be 'pending' by default from migration
        // ]);
    }
}
