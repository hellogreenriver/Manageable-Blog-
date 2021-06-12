<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
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
                'name' => '開発者',
                'role' => 'system',
                'email' => 'system@example.com'
            ],
            [
                'name' => '管理者',
                'role' => 'admin',
                'email' => 'admin@example.com'
            ],
            [
                'name' => 'user',
                'role' => 'user',
                'email' => 'user@example.com'
            ]
        ];

        foreach ($users as $user) {

            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'password' => bcrypt('secret')
            ]);
    
        }
    }
}
