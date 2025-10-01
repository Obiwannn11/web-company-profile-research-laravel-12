<?php

namespace App\Models;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicationCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}
