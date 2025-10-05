<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'q_id' => 'Apa saja layanan utama yang ditawarkan?',
                'a_id' => 'Kami menawarkan enam layanan utama: Desain Komponen, Pengukur Hasil Limbah, Analisis Data AI, Konsultasi R&D, Pelatihan & Kursus, dan Pencarian Alternatif.',
                'q_en' => 'What are the main services offered?',
                'a_en' => 'We offer six main services: Component Design, Waste Measurement, AI Data Analysis, R&D Consultation, Training & Courses, and Alternative Sourcing.',
            ],
            [
                'q_id' => 'Bagaimana cara memulai proyek dengan ReadyLab?',
                'a_id' => 'Anda dapat menghubungi kami melalui halaman kontak untuk menjadwalkan konsultasi awal dengan tim ahli kami.',
                'q_en' => 'How can I start a project with ReadyLab?',
                'a_en' => 'You can contact us through the contact page to schedule an initial consultation with our expert team.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            $newFaq = Faq::create([
                'name' => 'FAQ Item ' . ($index + 1),
                'sort_order' => $index + 1]
            );

            FaqTranslation::create([
                'faq_id' => $newFaq->id,
                'locale' => 'id',
                'question' => $faq['q_id'],
                'answer' => $faq['a_id'],
            ]);

            FaqTranslation::create([
                'faq_id' => $newFaq->id,
                'locale' => 'en',
                'question' => $faq['q_en'],
                'answer' => $faq['a_en'],
            ]);
        }
    }
}
