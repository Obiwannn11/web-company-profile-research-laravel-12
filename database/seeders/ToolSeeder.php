<?php

namespace Database\Seeders;

use App\Models\Tool;
use App\Models\ToolTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = [
            [
                'name' => 'Python & Scikit-learn',
                'logo' => 'placeholders/tool_python.png',
                'video' => 'https://www.youtube.com/watch?v=x7X9w_GIm1s',
                'title_id' => 'Python & Scikit-learn',
                'desc_id' => 'Untuk analisis data statistik dan machine learning.',
                'title_en' => 'Python & Scikit-learn',
                'desc_en' => 'For statistical data analysis and machine learning.',
            ],
            [
                'name' => 'Autocad',
                'logo' => 'placeholders/tool_autocad.png',
                'video' => 'https://www.youtube.com/watch?v=k_S5p-kbne4',
                'title_id' => 'AutoCAD',
                'desc_id' => 'Untuk desain komponen 2D dan 3D dengan presisi tinggi.',
                'title_en' => 'AutoCAD',
                'desc_en' => 'For high-precision 2D and 3D component design.',
            ],
        ];

        foreach ($tools as $tool) {
            $newTool = Tool::create([
                'name' => $tool['name'],
                'logo_image' => $tool['logo'],
                'video_url' => $tool['video'],
            ]);

            ToolTranslation::create([
                'tool_id' => $newTool->id, 'locale' => 'id',
                'title' => $tool['title_id'],
                'description' => $tool['desc_id'],
            ]);

            ToolTranslation::create([
                'tool_id' => $newTool->id, 'locale' => 'en',
                'title' => $tool['title_en'],
                'description' => $tool['desc_en'], 
                ]);
            }
    }
}
