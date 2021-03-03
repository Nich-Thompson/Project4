<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create(['name' => "admin",
            'email' => 'admin@inspectietool.nl',
            'password' => Hash::make('password'),
            'first_name' => 'admin',
            'last_name' => 'admin'
        ]);

        $inspector = User::create(['name' => "inspector",
            'email' => 'inspector@inspectietool.nl',
            'password' => Hash::make('password'),
            'first_name' => 'Frans',
            'last_name' => 'duijts'
        ]);

        $admin->assignRole('admin');
        $inspector ->assignRole('inspecteur');
    }
}
