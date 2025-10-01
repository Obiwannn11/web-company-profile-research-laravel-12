<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'sort_order',
    ];

    public function translations()
    {
        return $this->hasMany(TeamTranslation::class);
    }
}
