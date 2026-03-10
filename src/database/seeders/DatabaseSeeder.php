<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Contact;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => '商品のお届けについて'],
            ['name' => '商品の交換について'],
            ['name' => '商品トラブル'],
            ['name' => 'ショップへのお問い合わせ'],
            ['name' => 'その他'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        Contact::factory()->count(35)->create();
    }
}