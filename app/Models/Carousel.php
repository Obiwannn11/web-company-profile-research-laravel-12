<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\CarouselTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carousel extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'link_url',
        'sort_order',
    ];
    public function translations()
    {
        return $this->hasMany(CarouselTranslation::class);
    }

    protected function currentTranslation(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $translation = $this->translations->firstWhere('locale', app()->getLocale());
                return $translation ?? (object)[
                    'title' => '',
                    'subtitle' => '',
                    'button_text' => '',
                ];
            },
        );
    }

    protected function finalUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $url = $this->link_url; 
                
                if (!$url) {
                    return '#';
                }

                // Cek jika link eksternal misal ada http
                if (Str::startsWith($url, 'http')) {
                    return $url;
                }

                // Cek jika link internal misal /
                if (Str::startsWith($url, '/')) {
                    // Otomatis tambahkan locale yang aktif
                    return url(app()->getLocale() . $url);
                }

                return $url;
            },
        );
    }

    
}
