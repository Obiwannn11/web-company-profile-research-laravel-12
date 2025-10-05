<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\TeamTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = [
            ['name' => 'Dr. Budi Santoso', 'position' => 'Kepala Peneliti', 'expertise' => 'AI & Machine Learning', 'photo' => 'placeholders/team1.jpg'],
            ['name' => 'Citra Lestari, M.Sc.', 'position' => 'Analis Data Senior', 'expertise' => 'Big Data & Statistik', 'photo' => 'placeholders/team2.jpg'],
            ['name' => 'Agus Wijaya, S.Kom.', 'position' => 'Insinyur Perangkat Lunak', 'expertise' => 'Pengembangan Aplikasi & Sistem', 'photo' => 'placeholders/team3.jpg'],
        ];

        foreach ($team as $index => $member) {
            $newMember = Team::create([
                'name' => $member['name'],
                'photo' => $member['photo'],
                'sort_order' => $index + 1,
            ]);

            TeamTranslation::create([
                'team_id' => $newMember->id, 'locale' => 'id', 'name' => $member['name'], 'position' => $member['position'], 'expertise' => $member['expertise'], 'details' => 'Detail lebih lanjut tentang keahlian dan pengalaman ' . $member['name']
            ]);

            TeamTranslation::create([
                'team_id' => $newMember->id, 'locale' => 'en', 'name' => $member['name'], 'position' => 'Senior Researcher', 'expertise' => $member['expertise'], 'details' => 'More details about the expertise and experience of ' . $member['name']
            ]);
        }
    }
}
