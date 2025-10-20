<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            'navbar_name', 'navbar_home', 'navbar_services', 'navbar_rnd', 'navbar_tools', 'navbar_about_us', 'navbar_contact_us',
            'hero_title', 'hero_subtitle', 'hero_button_text',
            'home_services_title', 'home_services_subtitle','cta_title', 'cta_subtitle', 'cta_button_text',
            'contact_address', 'contact_phone', 'contact_email', 'contact_maps_url',
            'company_name', 'company_focus', 'company_history',
            'footer_name', 'footer_contact', 'footer_social_media',
        ];

        foreach ($contents as $key) {
            $content = SiteContent::create(['key' => $key]);
            // Buat entri terjemahan kosong untuk ID dan EN
            $content->translations()->create(['locale' => 'id', 'value' => 'Isi teks ' . str_replace('_', ' ', $key)]);
            $content->translations()->create(['locale' => 'en', 'value' => 'Fill in the ' . str_replace('_', ' ', $key) . ' text']);
        }
    }
}
