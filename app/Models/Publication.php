<?php

namespace App\Models;

use App\Models\PublicationTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'name',
        'publication_category_id',
        'hero_image',
        'slug',
    ];

    public function translations()
    {
        return $this->hasMany(PublicationTranslation::class);
    }

    public function category()
    {
        return $this->belongsTo(PublicationCategory::class, 'publication_category_id');
    }

    public function getTranslation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        
        return $this->translations->firstWhere('locale', $locale) 
            ?? (object)['title' => 'Judul tidak tersedia', 'content' => ''];
    }

    public function getCategoryTranslation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        
        if (!$this->category || !$this->category->translations) {
            return (object)['name' => 'Tanpa Kategori'];
        }
        
        return $this->category->translations->firstWhere('locale', $locale)
            ?? (object)['name' => 'Tanpa Kategori'];
    }

    protected function currentTranslation(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // Cari terjemahan berdasarkan locale aktif
                $translation = $this->translations->firstWhere('locale', app()->getLocale());

                // Jika tidak ketemu, kembalikan objek default
                return $translation ?? (object)[
                    'title' => 'Judul tidak tersedia',
                    'content' => ''
                ];
            },
        );
    }

    protected function currentCategoryTranslation(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $category = $this->category; // Akses relasi category
                $translation = null;

                // Cek jika category dan relasi translations-nya ada
                if ($category && $category->translations) {
                    $translation = $category->translations->firstWhere('locale', app()->getLocale());
                }

                // Jika tidak ketemu, kembalikan objek default
                return $translation ?? (object)[
                    'name' => 'Tanpa Kategori'
                ];
            },
        );
    }
}
