<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ImportProductCategoriesSeeder extends Seeder
{
    /**
     * Pull distinct category strings from products and insert into categories.
     */
    public function run(): void
    {
        $categories = Product::distinct()->pluck('category')->filter()->unique();

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}















