<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'image' => 'placeholders/carousel1.jpg', // Pastikan Anda memiliki gambar ini di public/storage/placeholders
                'link_url' => '/id/services',
                'sort_order' => 1,
                'translations' => [
                    'id' => [
                        'title' => 'Analisis Data AI Tercanggih',
                        'subtitle' => 'Mengubah data kompleks menjadi wawasan bisnis yang strategis.',
                        'button_text' => 'Lihat Layanan Kami',
                    ],
                    'en' => [
                        'title' => 'Advanced AI Data Analysis',
                        'subtitle' => 'Turning complex data into strategic business insights.',
                        'button_text' => 'View Our Services',
                    ],
                ],
            ],
            [
                'image' => 'placeholders/carousel2.jpg', // Pastikan Anda memiliki gambar ini
                'link_url' => '/id/about/company',
                'sort_order' => 2,
                'translations' => [
                    'id' => [
                        'title' => 'Riset & Pengembangan Inovatif',
                        'subtitle' => 'Tim ahli kami siap mewujudkan ide Anda.',
                        'button_text' => 'Tentang Kami',
                    ],
                    'en' => [
                        'title' => 'Innovative R&D',
                        'subtitle' => 'Our expert team is ready to bring your ideas to life.',
                        'button_text' => 'About Us',
                    ],
                ],
            ],
        ];

        // Loop dan masukkan data ke database
        foreach ($slides as $slideData) {
            // Buat entri di tabel 'carousels'
            $carousel = Carousel::create([
                'image' => $slideData['image'],
                'link_url' => $slideData['link_url'],
                'sort_order' => $slideData['sort_order'],
            ]);

            // Buat entri terjemahan terkait
            foreach ($slideData['translations'] as $locale => $data) {
                $carousel->translations()->create([
                    'locale' => $locale,
                    'title' => $data['title'],
                    'subtitle' => $data['subtitle'],
                    'button_text' => $data['button_text'],
                ]);
            }
        }
    }
}
