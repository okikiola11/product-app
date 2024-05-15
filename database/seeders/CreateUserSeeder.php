<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
                [
                    'name' => 'User',
                    'email' => 'user@test.com',
                    'password' => bcrypt('12345'),
                    'role' => 0,
                ],
                [
                    'name' => 'Lecturer',
                    'email' => 'lecturer@test.com',
                    'password' => bcrypt('12345'),
                    'role' => 1,
                ],
                [
                    'name' => 'Admin',
                    'email' => 'admin@test.com',
                    'password' => bcrypt('12345'),
                    'role' => 2,
                ]
            ];

            foreach($users as $user) {
                User::create($user);
            }
    }
}
