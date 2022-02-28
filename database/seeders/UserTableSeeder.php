<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Ikhsan Heriyawan',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'date_of_birth' => '2001-02-19',
                'bio' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes',
                'role' => 'admin',
                'gender' => 'L',
                'image' => 'img/profile/irp-logo.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Kuncoro',
                'email' => 'user@gmail.com',
                'password' => Hash::make('admin'),
                'date_of_birth' => '1998-02-19',
                'bio' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes',
                'role' => 'user',
                'gender' => 'P',
                'image' => 'img/profile/irp-logo.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
