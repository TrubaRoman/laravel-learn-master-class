<?php

use Illuminate\Database\Seeder;
use App\Models\Adverts\Category;

class AdvertCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() :void
    {
        factory(Category::class,2)->create()->each(function (Category $category) {
            $counts = [0,random_int(3,5)];
            $category->children()->saveMany(factory(Category::class, $counts[array_rand($counts)])->create()->each(function (Category $category){

                $counts = [0,random_int(3,5)];
                $category->children()->saveMany(factory(Category::class, $counts[array_rand($counts)])->create());
            }));
        });
    }
}
