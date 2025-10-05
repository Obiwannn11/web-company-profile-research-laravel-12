<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ServiceTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'component_design', 'id_title' => 'Desain Komponen', 'en_title' => 'Component Design'],
            ['name' => 'waste_measurement', 'id_title' => 'Pengukur Hasil Limbah', 'en_title' => 'Waste Measurement'],
            ['name' => 'ai_data_analysis', 'id_title' => 'Analisis Data AI', 'en_title' => 'AI Data Analysis'],
            ['name' => 'rd_consultation', 'id_title' => 'Konsultasi R&D', 'en_title' => 'R&D Consultation'],
            ['name' => 'training_courses', 'id_title' => 'Pelatihan & Kursus', 'en_title' => 'Training & Courses'],
            ['name' => 'alternative_sourcing', 'id_title' => 'Pencarian Alternatif', 'en_title' => 'Alternative Sourcing'],
        ];

        foreach ($services as $s) {
            $service = Service::create([
                'name' => $s['name'],
                'slug' => Str::slug($s['en_title']),
                'hero_image' => 'placeholders/service_hero.jpg', // Ganti dengan path gambar asli nanti
            ]);

            ServiceTranslation::create([
                'service_id' => $service->id,
                'locale' => 'id',
                'title' => $s['id_title'],
                'description' => 'Ini adalah deskripsi singkat untuk ' . $s['id_title'],
                'content' => 'Ini adalah konten lengkap dalam format HTML untuk ' . $s['id_title'] . '. Anda bisa menambahkan <img> dan tag lainnya di sini.',
            ]);

            ServiceTranslation::create([
                'service_id' => $service->id,
                'locale' => 'en',
                'title' => $s['en_title'],
                'description' => 'This is a short description for ' . $s['en_title'],
                'content' => 'This is the full HTML content for ' . $s['en_title'] . '. You can add <img> and other tags here.',
            ]);
        }
    }
}
