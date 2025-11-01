<?php

namespace Database\Seeders;

use App\Models\Publication;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\PublicationCategory;
use App\Models\PublicationTranslation;
use App\Models\PublicationCategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Kategori terlebih dahulu
        $categories = [
            ['name' => 'Artikel Riset1 ', 'id' => 'Artikel Riset', 'en' => 'Research Articles', 'slug' => 'research-articles'],
            ['name' => 'Artikel Riset2', 'id' => 'Jurnal', 'en' => 'Journal', 'slug' => 'journal'],
            ['name' => 'Artikel Riset3', 'id' => 'Buku', 'en' => 'Book', 'slug' => 'book'],
        ];

        foreach ($categories as $cat) {
            $category = PublicationCategory::create(['name' => $cat['name'], 'slug' => $cat['slug']]);
        PublicationCategoryTranslation::create(['pub_category_trans' => $category->id, 'locale' => 'id', 'name' => $cat['id']]);
            PublicationCategoryTranslation::create(['pub_category_trans' => $category->id, 'locale' => 'en', 'name' => $cat['en']]);
        }

        // 2. Buat beberapa data publikasi
        $publications = [
            [
                'name' => 'Publication 1',
                'cat_slug' => 'research-articles', 'img' => 'placeholders/pub1.jpg',
                'title_id' => 'Studi Kasus AI dalam Manajemen Limbah', 'content_id' => 'Konten lengkap tentang studi kasus...',
                'title_en' => 'AI Case Study in Waste Management', 'content_en' => 'Full content about the case study...',
            ],
            [
                'name' => 'Publication 2',
                'cat_slug' => 'journal', 'img' => 'placeholders/pub2.jpg',
                'title_id' => 'Jurnal Inovasi Material Komposit', 'content_id' => 'Konten lengkap tentang jurnal inovasi...',
                'title_en' => 'Journal of Composite Material Innovation', 'content_en' => 'Full content about the innovation journal...',
            ],
        ];

        foreach ($publications as $pub) {
            $category = PublicationCategory::where('slug', $pub['cat_slug'])->first();

            if($category) {
                $slug = Str::slug($pub['title_en']);
                $publication = Publication::create([
                    'name' => $pub['name'],
                    'publication_category_id' => $category->id,
                    'hero_image' => $pub['img'],
                    'slug' => $slug, 
                ]);
            }
                PublicationTranslation::create(['publication_id' => $publication->id, 'locale' => 'id', 'title' => $pub['title_id'], 'content' => $pub['content_id']]);
            PublicationTranslation::create(['publication_id' => $publication->id, 'locale' => 'en', 'title' => $pub['title_en'], 'content' => $pub['content_en']]);
        }
    }
}
