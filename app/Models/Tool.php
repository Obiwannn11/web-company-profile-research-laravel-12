<?php

namespace App\Models;

use App\Models\ToolTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_image',
        'description',
        'video_url',
    ];

    public function translations()
    {
        return $this->hasMany(ToolTranslation::class);
    }
}
