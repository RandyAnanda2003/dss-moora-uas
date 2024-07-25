<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteria = [
            [
                'name' => 'Integrity',
                'type' => 'Benefit',
                'weight' => 0.100
            ],
            [
                'name' => 'Communication',
                'type' => 'Benefit',
                'weight' => 0.150
            ],
            [
                'name' => 'Dependable',
                'type' => 'Benefit',
                'weight' => 0.050
            ],
            [
                'name' => 'Problem Solving',
                'type' => 'Benefit',
                'weight' => 0.200
            ],
            [
                'name' => 'Quality of Works',
                'type' => 'Benefit',
                'weight' => 0.150
            ],
            [
                'name' => 'Technical Skill',
                'type' => 'Benefit',
                'weight' => 0.100
            ],
            [
                'name' => 'Creativity',
                'type' => 'Benefit',
                'weight' => 0.050
            ],
            [
                'name' => 'Adaptability',
                'type' => 'Benefit',
                'weight' => 0.075
            ],
            [
                'name' => 'Productivity',
                'type' => 'Benefit',
                'weight' => 0.075
            ],
            [
                'name' => 'Attendance',
                'type' => 'Benefit',
                'weight' => 0.050
            ]
        ];

        foreach ($criteria as $criterion) {
            Criteria::create($criterion);
        }
    }
}
