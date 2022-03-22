<?php

use Illuminate\Database\Seeder;
use App\categories;
use Illuminate\Support\Str;

class categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $categories= ['dati','testo','image'];
        foreach ($categories as $category) { 
            $newCategory = new categories();
            $newCategory->type=$category;
            $newCategory->slug= Str::of($category)->slug('-');
            $newCategory->save();
        }
    }
}