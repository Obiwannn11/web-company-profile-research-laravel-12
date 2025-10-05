<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicationCategoryTranslation extends Model
{
    use HasFactory ;
    protected $fillable = [
        'publication_category_id',
        'locale',
        'name',
    ];
}
