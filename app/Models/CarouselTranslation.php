<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarouselTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'carousel_id',
        'locale',
        'title',
        'subtitle',
        'button_text',
    ];
}
