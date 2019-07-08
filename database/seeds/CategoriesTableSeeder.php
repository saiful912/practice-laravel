<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            'name'=>'Design',
            'slug'=>str_slug('Design')
        ],[
            'name'=>'Design',
            'slug'=>str_slug('Design')
        ]);
    }

    //Factories
//    public function run()
//    {
//        factory(\App\Models\Category::class,10);
//    }
}
