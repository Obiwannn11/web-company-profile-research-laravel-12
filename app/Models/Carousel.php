<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarouselTranslation;

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
}
