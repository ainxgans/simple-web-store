<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('TRUNCATE TABLE master.users RESTART IDENTITY CASCADE;');
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $cs1 = Role::firstOrCreate(['name' => 'cs1']);
        $cs2 = Role::firstOrCreate(['name' => 'cs2']);
        $user = Role::firstOrCreate(['name' => 'user']);

        $dummyAdmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);
        $dummyAdmin->assignRole($admin);

        $dummyCs1 = User::create([
            'name' => 'Customer Service Layer 1',
            'email' => 'cs1@mail.com',
            'password' => Hash::make('password'),
        ]);
        $dummyCs1->assignRole($cs1);
        $dummyCs2 = User::create([
            'name' => 'Customer Service Layer 2',
            'email' => 'cs2@mail.com',
            'password' => Hash::make('password'),
        ]);
        $dummyCs2->assignRole($cs2);
        $dummyUser = User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
        ]);
        $dummyUser->assignRole($user);
    }
}
