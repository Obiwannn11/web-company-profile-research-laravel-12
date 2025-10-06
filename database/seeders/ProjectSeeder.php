<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use App\Models\ProjectTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Project 1',
                'type' => 'project', 'category' => 'external', 'icon' => 'placeholders/proj_icon1.png',
                'title_id' => 'Sistem Monitoring Limbah PT ABC', 'details_id' => 'Klien: PT ABC',
                'desc_id' => 'Deskripsi lengkap tentang proyek sistem monitoring...',
                'title_en' => 'Waste Monitoring System for PT ABC', 'details_en' => 'Client: PT ABC',
                'desc_en' => 'Full description about the monitoring system project...',
            ],
            [
                'name' => 'Project 2',
                'type' => 'project', 'category' => 'internal', 'icon' => 'placeholders/proj_icon1.png',
                'title_id' => 'Sistem Monitoring Lampu PT XYZ', 'details_id' => 'Klien: PT XYZ',
                'desc_id' => 'Deskripsi lengkap tentang proyek sistem monitoring...',
                'title_en' => 'Waste Monitoring System for PT XYZ', 'details_en' => 'Client: PT XYZ',
                'desc_en' => 'Full description about the monitoring system project...',
            ],
            [
                'name' => 'Research 1',
                'type' => 'research', 'category' => 'external', 'icon' => 'placeholders/proj_icon2.png',
                'title_id' => 'Riset Material Alternatif Hemat Biaya', 'details_id' => 'Status: Berlangsung',
                'desc_id' => 'Deskripsi lengkap tentang riset internal material...',
                'title_en' => 'Research on Cost-Effective Material Alternatives', 'details_en' => 'Status: Ongoing',
                'desc_en' => 'Full description about the internal material research...',
            ],
            [
                'name' => 'Research 2',
                'type' => 'research', 'category' => 'internal', 'icon' => 'placeholders/proj_icon2.png',
                'title_id' => 'Riset Material Alternatif Ramah Lingkungan', 'details_id' => 'Status: Berlangsung',
                'desc_id' => 'Deskripsi lengkap tentang riset internal material...',
                'title_en' => 'Research on Eco-Friendly Material Alternatives', 'details_en' => 'Status: Ongoing',
                'desc_en' => 'Full description about the internal material research...',
            ],
        ];

        foreach ($projects as $index => $proj) {
            $project = Project::create([
                'name' => $proj['name'],
                'type' => $proj['type'], 
                'category' => $proj['category'],
                'image' => $proj['icon'], 'sort_order' => $index + 1,
            ]);

            ProjectTranslation::create(['project_id' => $project->id, 'locale' => 'id', 'title' => $proj['title_id'], 'details' => $proj['details_id'], 'description' => $proj['desc_id']]);
            ProjectTranslation::create(['project_id' => $project->id, 'locale' => 'en', 'title' => $proj['title_en'], 'details' => $proj['details_en'], 'description' => $proj['desc_en']]);
        }
    }
}
