<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert([
            [
                'name' => 'Bootstrap',
                'slug' => 'bootstrap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tailwind CSS',
                'slug' => 'tailwind-css',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
