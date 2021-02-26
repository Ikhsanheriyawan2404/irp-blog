<?php

namespace Database\Seeders;

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
                'name' => 'Ikhsan Heriyawan',
                'email' => 'ikhsan24@gmail.com',
                'password' => Hash::make('ikhsan24'),
                'date_of_birth' => '2001-02-19',
                'bio' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes',
                'role' => 'user',
                'gender' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kuncoro',
                'email' => 'ikhsan@gmail.com',
                'password' => Hash::make('ikhsan24'),
                'date_of_birth' => '1998-02-19',
                'bio' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes',
                'role' => 'user',
                'gender' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
