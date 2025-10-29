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
            'rnd_project_title', 'rnd_project_subtitle', 'rnd_project_internal', 'rnd_project_external',
            'rnd_publication_title', 'rnd_publication_subtitle',
            'rnd_research_title', 'rnd_research_subtitle', 'rnd_research_internal', 'rnd_research_external',
            'contact_address', 'contact_phone', 'contact_email', 'contact_maps_url', 'contact_title', 'contact_subtitle',
            'tools_title', 'tools_subtitle', 'team_title_web','team_title', 'team_subtitle',
            'faq_title_web', 'faq_title', 'faq_subtitle',
            'company_name', 'company_focus', 'company_history', 'company_title',
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
