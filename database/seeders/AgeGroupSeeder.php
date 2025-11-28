<?php

namespace Database\Seeders;

use App\Models\AgeGroup;
use Illuminate\Database\Seeder;

class AgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ageGroups = [
            [
                'name' => 'Boys',
                'min_age' => 2,
                'max_age' => 16,
            ],
            [
                'name' => 'Girls',
                'min_age' => 2,
                'max_age' => 16,
            ],
        ];

        foreach ($ageGroups as $ageGroup) {
            AgeGroup::create($ageGroup);
        }
    }
}
