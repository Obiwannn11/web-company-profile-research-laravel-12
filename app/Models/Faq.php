<?php

namespace App\Models;

use App\Models\FaqTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort_order',
    ];

    public function translations()
    {
        return $this->hasMany(FaqTranslation::class);
    }
}
