<?php

namespace App\Models;

use App\Models\PublicationTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'name',
        'publication_category_id',
        'hero_image',
    ];

    public function translations()
    {
        return $this->hasMany(PublicationTranslation::class);
    }

    public function category()
    {
        return $this->belongsTo(PublicationCategory::class, 'publication_category_id');
    }
}
