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
                'name' => 'Berita',
                'slug' => 'berita',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sejarah',
                'slug' => 'sejarah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknologi',
                'slug' => 'teknologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Politik',
                'slug' => 'politik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agama',
                'slug' => 'agama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ekonomi',
                'slug' => 'ekonomi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sosial',
                'slug' => 'sosial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
