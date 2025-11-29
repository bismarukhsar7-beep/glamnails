<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Rose Pink Polish', 'price' => 860, 'category' => 'Nail Polishes', 'image' => 'images/nailpolish1.jpg', 'desc' => 'Glossy rose pink nail polish with long-lasting shine.'],
            ['name' => 'Coral Bliss Polish', 'price' => 870, 'category' => 'Nail Polishes', 'image' => 'images/nailpolish2.jpg', 'desc' => 'Soft coral shade perfect for summer vibes.'],
            ['name' => 'Ruby Red Polish', 'price' => 880, 'category' => 'Nail Polishes', 'image' => 'images/nailpolish3.jpg', 'desc' => 'Rich red polish for bold and confident look.'],
            ['name' => 'Lavender Dream Polish', 'price' => 890, 'category' => 'Nail Polishes', 'image' => 'images/nailpolish4.jpg', 'desc' => 'A dreamy lavender shade for everyday glam.'],
            ['name' => 'Nude Elegance Polish', 'price' => 900, 'category' => 'Nail Polishes', 'image' => 'images/nailpolish5.jpg', 'desc' => 'Perfect nude tone for classy and simple nails.'],

            ['name' => 'Rhinestone Set', 'price' => 525, 'category' => 'Accessories', 'image' => 'images/accessory1.jpg', 'desc' => 'Add sparkle with assorted rhinestones for nail art.'],
            ['name' => 'Nail Stickers Pack', 'price' => 540, 'category' => 'Accessories', 'image' => 'images/accessory2.jpg', 'desc' => 'Trendy nail stickers for easy styling.'],
            ['name' => 'Glam Foil Set', 'price' => 555, 'category' => 'Accessories', 'image' => 'images/accessory3.jpg', 'desc' => 'Add metallic flair with foil designs.'],
            ['name' => 'Pearl Art Kit', 'price' => 570, 'category' => 'Accessories', 'image' => 'images/accessory4.jpg', 'desc' => 'Classic pearl set for elegant nail designs.'],
            ['name' => 'Chrome Powder', 'price' => 585, 'category' => 'Accessories', 'image' => 'images/accessory5.jpg', 'desc' => 'Give your nails a mirror-like chrome finish.'],

            ['name' => 'Cuticle Oil', 'price' => 970, 'category' => 'Nail Care', 'image' => 'images/nailcare1.jpg', 'desc' => 'Keep your cuticles soft and hydrated.'],
            ['name' => 'Nail Strengthener', 'price' => 990, 'category' => 'Nail Care', 'image' => 'images/nailcare2.jpg', 'desc' => 'Strengthen weak nails with nourishing formula.'],
            ['name' => 'Nail Cleanser', 'price' => 1010, 'category' => 'Nail Care', 'image' => 'images/nailcare3.jpg', 'desc' => 'Cleans and preps your nails before polish.'],
            ['name' => 'Hand Moisturizer', 'price' => 1030, 'category' => 'Nail Care', 'image' => 'images/nailcare4.jpg', 'desc' => 'Smooth hand lotion for silky soft skin.'],
            ['name' => 'Nail Serum', 'price' => 1050, 'category' => 'Nail Care', 'image' => 'images/nailcare5.jpg', 'desc' => 'Boost nail health and shine with serum.'],

            ['name' => 'Manicure Set', 'price' => 790, 'category' => 'Tools', 'image' => 'images/tool1.jpg', 'desc' => 'Complete manicure kit with all essentials.'],
            ['name' => 'Nail Buffer', 'price' => 820, 'category' => 'Tools', 'image' => 'images/tool2.jpg', 'desc' => 'Smooth and shape your nails to perfection.'],
            ['name' => 'Cuticle Pusher', 'price' => 850, 'category' => 'Tools', 'image' => 'images/tool3.jpg', 'desc' => 'Professional tool for neat cuticle care.'],
            ['name' => 'Nail File Set', 'price' => 880, 'category' => 'Tools', 'image' => 'images/tool4.jpg', 'desc' => 'High-quality files for salon-like finish.'],
            ['name' => 'UV Lamp', 'price' => 910, 'category' => 'Tools', 'image' => 'images/tool5.jpg', 'desc' => 'Portable UV lamp for gel polish curing.'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
