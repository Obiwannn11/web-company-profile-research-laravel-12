<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SettingTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['name' => 'alamat','key' => 'contact.address', 'id_value' => 'Jl. Inovasi No. 123, Makassar, Indonesia', 'en_value' => '123 Innovation St., Makassar, Indonesia'],
            ['name' => 'email','key' => 'contact.email', 'id_value' => 'halo@readylab.id', 'en_value' => 'hello@readylab.com'],
            ['name' => 'telepon','key' => 'contact.phone', 'id_value' => '+62 812 3456 7890', 'en_value' => '+62 812 3456 7890'],
            ['name' => 'instagram','key' => 'contact.instagram_url', 'id_value' => 'https://instagram.com', 'en_value' => 'https://instagram.com'],
            ['name' => 'maps','key' => 'contact.maps_url', 'id_value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.743132623305!2d119.44797931534213!3d-5.145013096265719!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee2b8348c6969%3A0x77427189a42b102b!2sFort%20Rotterdam%20Makassar!5e0!3m2!1sen!2sid!4v1678886400000', 'en_value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.743132623305!2d119.44797931534213!3d-5.145013096265719!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee2b8348c6969%3A0x77427189a42b102b!2sFort%20Rotterdam%20Makassar!5e0!3m2!1sen!2sid!4v1678886400000'],
            ['name' => 'company_name','key' => 'company.name', 'id_value' => 'PT Riset Laboratorium Digital (ReadyLab)', 'en_value' => 'Digital Research Laboratory, Inc. (ReadyLab)'],
            ['name' => 'company_focus','key' => 'company.focus', 'id_value' => 'Mendorong Inovasi Melalui Riset Terapan dan Analisis Data Cerdas', 'en_value' => 'Driving Innovation Through Applied Research and Intelligent Data Analysis'],
            ['name' => 'company_history','key' => 'company.history', 'id_value' => 'Berdiri sejak 2020, ReadyLab berfokus pada penyediaan solusi riset dan pengembangan untuk industri di Indonesia.', 'en_value' => 'Founded in 2020, ReadyLab focuses on providing R&D solutions for industries in Indonesia.'],
        ];

        foreach ($settings as $setting) {
            SettingTranslation::create(['name' => $setting['name'], 'key' => $setting['key'], 'locale' => 'id', 'value' => $setting['id_value']]);
            SettingTranslation::create(['name' => $setting['name'], 'key' => $setting['key'], 'locale' => 'en', 'value' => $setting['en_value']]);
        }
    }
}
