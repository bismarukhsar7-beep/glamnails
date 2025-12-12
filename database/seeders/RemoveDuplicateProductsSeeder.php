<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class RemoveDuplicateProductsSeeder extends Seeder
{
    /**
     * Remove duplicate products keeping the lowest id per (name, category).
     */
    public function run(): void
    {
        // Group by name + category and keep the minimum id from each group
        $dupes = Product::select('name', 'category', DB::raw('MIN(id) as keep_id'))
            ->groupBy('name', 'category')
            ->get();

        $keepIds = $dupes->pluck('keep_id');

        // Delete all products not in the keep list
        $deleted = Product::whereNotIn('id', $keepIds)->delete();

        $this->command?->info("Deleted duplicate products: {$deleted}");
    }
}















