<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Turf;

class TurfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $turfs = [
            [
                'name' => 'Premium Football Turf',
                'description' => 'Professional football turf with natural grass and excellent drainage system. Perfect for competitive matches and training sessions.',
                'sport_type' => 'football',
                'price_per_hour' => 50.00,
                'image_path' => 'turfs/turf-1.jpg',
                'features' => ['natural_grass', 'floodlights', 'drainage_system'],
                'status' => 'available'
            ],
            [
                'name' => 'Cricket Ground',
                'description' => 'Professional cricket ground with proper pitch, boundary ropes, and practice nets. Ideal for cricket matches and training.',
                'sport_type' => 'cricket',
                'price_per_hour' => 60.00,
                'image_path' => 'turfs/turf-2.jpg',
                'features' => ['practice_nets', 'scoreboard', 'boundary_ropes'],
                'status' => 'available'
            ],
            [
                'name' => 'Tennis Court',
                'description' => 'Professional tennis court with synthetic surface and proper markings. Perfect for tennis matches and coaching sessions.',
                'sport_type' => 'tennis',
                'price_per_hour' => 40.00,
                'image_path' => 'turfs/turf-3.jpg',
                'features' => ['synthetic_surface', 'net_system', 'proper_markings'],
                'status' => 'maintenance'
            ],
            [
                'name' => 'Multi-Sport Arena',
                'description' => 'Versatile turf for multiple sports activities including football, cricket, and other outdoor sports.',
                'sport_type' => 'multi_sport',
                'price_per_hour' => 45.00,
                'image_path' => 'turfs/turf-1.jpg',
                'features' => ['versatile', 'floodlights', 'changing_rooms'],
                'status' => 'available'
            ]
        ];

        foreach ($turfs as $turf) {
            Turf::create($turf);
        }
    }
}
