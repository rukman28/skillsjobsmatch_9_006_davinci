<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@skillsjobmatch.org',
            'email_verified_at' => now(),
            'password' => Hash::make('6rJU26GRATuL2cm'), // 6rJU26GRATuL2cm
        ]);
        $admin->assignRole('admin');

        $admin = User::create([
            'name' => 'Editor',
            'email' => 'editor@skillsjobmatch.org',
            'email_verified_at' => now(),
            'password' => Hash::make('6rJU26GRATuL2cm'), // 6rJU26GRATuL2cm
        ]);
        $admin->assignRole('editor');


    }
}
