<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'lastname'       => '',
                'phone'          => '',
                'country'        => '',
                'city'           => '',
                'address_1'      => '',
                'address_2'      => '',
                'kyc'            => '',
                'image'          => '',
            ],
        ];

        User::insert($users);
    }
}
