<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DemoUsersSeeder extends Seeder
{
 
     public function run(){
        User::create([
           'name' => 'Dharmendra Laxkar',
           'role' => 'admin',
           'status' => 'active',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@1234')
        ]);

        User::create([
           'name' => 'Kishan Lal',
           'role' => 'user',
           'status' => 'active',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user@1234')
        ]);

        User::create([
           'name' => 'Jagdish Lal',
           'role' => 'manager',
           'status' => 'active',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager@1234')
        ]);
     }
}
