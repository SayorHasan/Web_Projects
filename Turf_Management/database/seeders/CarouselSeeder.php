<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarouselImage;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carouselImages = [
            [
                'title' => 'Football Excellence',
                'description' => 'Experience the thrill of professional football on our premium turfs',
                'image_path' => 'carousel/football-1.jpg',
                'sport_type' => 'football',
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Cricket Paradise',
                'description' => 'Perfect pitches for your cricket matches and tournaments',
                'image_path' => 'carousel/cricket-1.jpg',
                'sport_type' => 'cricket',
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Multi-Sport Arena',
                'description' => 'Versatile facilities for all your sporting needs',
                'image_path' => 'carousel/football-2.jpg',
                'sport_type' => 'multi_sport',
                'order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Aquatic Sports',
                'description' => 'Dive into excellence with our swimming facilities',
                'image_path' => 'carousel/pool-1.jpg',
                'sport_type' => 'swimming',
                'order' => 4,
                'is_active' => true
            ]
        ];

        foreach ($carouselImages as $image) {
            CarouselImage::create($image);
        }
    }
}
