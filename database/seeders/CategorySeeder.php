<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Accessories',
                'description' => 'Kids accessories including backpacks, hats, mittens and more',
            ],
            [
                'name' => 'Outerwear',
                'description' => 'Jackets, coats, and fleece for all seasons',
            ],
            [
                'name' => 'Shoes',
                'description' => 'Sneakers, trainers, heels and more footwear',
            ],
            [
                'name' => 'Tops',
                'description' => 'T-shirts, polo shirts, jumpers and long sleeve shirts',
            ],
            [
                'name' => 'Trousers',
                'description' => 'Joggers, jeans, skirts and other bottoms',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
