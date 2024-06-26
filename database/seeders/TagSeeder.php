<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'GAMING',
                'status' => 1
            ],
            [
                'name' => 'MORNING',
                'status' => 1
            ],
            [
                'name' => 'RELAXING',
                'status' => 1
            ],
        ];

        foreach ($tags as $tag)
        {
            Tag::query()->create($tag);
        }
    }
}
