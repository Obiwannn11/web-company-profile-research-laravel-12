<?php

namespace App\Models;

use App\Models\ServiceTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'hero_image'];

    public function translations()
    {
        return $this->hasMany(ServiceTranslation::class);
    }
}
