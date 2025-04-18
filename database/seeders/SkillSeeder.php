<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'Laravel',
            'Vue.js',
            'React',
            'Node.js',
            'PHP',
            'JavaScript',
            'MySQL',
            'AWS',
            'Docker',
            'Git',
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill]);
        }
    }
}
