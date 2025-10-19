<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
    ];

    public function translations()
    {
        return $this->hasMany(SiteContentTranslation::class);
    }
}
