<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert(array(
            'description' => 'Sports',
            'status' => 1,
        ));
        \DB::table('categories')->insert(array(
            'description' => 'Technologies',
            'status' => 1,
        ));
        \DB::table('categories')->insert(array(
            'description' => 'Art',
            'status' => 1,
        ));
    }
}
