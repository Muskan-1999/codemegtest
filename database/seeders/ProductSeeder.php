<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Samsung Galaxy',
                'price' => 100,
                'stock'=>2
            ],
            [
                'name' => 'Apple iPhone 12',
                'price' => 10000,
                'stock'=>2
            ],
            [
                'name' => 'Google Pixel 2 XL',
                'price' => 45660,
                'stock'=>5
            ],
            [
                'name' => 'LG V10 H800',
                'price' => 20000,
                'stock'=>3
            ]
        ];
  
        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}
