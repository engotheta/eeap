<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Default User',
            'email' => 'admin@tnbc.go.tz',
            'password' => bcrypt('Admin@12345'),
        ]);

        $admin->assignRole(1);

        $users = [];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
