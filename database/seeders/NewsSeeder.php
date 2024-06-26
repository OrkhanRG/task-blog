<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Active',
                'slug' => 'active',
                'description' => 'Description Active',
                'status' => 1
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Description Business',
                'status' => 1
            ],
            [
                'name' => 'Crazy',
                'slug' => 'crazy',
                'description' => 'Description Crazy',
                'status' => 1
            ],
            [
                'name' => 'Gaming',
                'slug' => 'gaming',
                'description' => 'Description Gaming',
                'status' => 1
            ],
            [
                'name' => 'Health',
                'slug' => 'health',
                'description' => 'Description Health',
                'status' => 1
            ],
            [
                'name' => 'Science',
                'slug' => 'science',
                'description' => 'Description Science',
                'status' => 1
            ],
        ];

        foreach ($categories as $category)
        {
            Category::query()->create($category);
        }
    }
}
