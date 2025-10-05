<?php

namespace App\Models;

use App\Models\ProjectTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'category', 'image', 'sort_order'];

    //category = internal/external
    //type = project/research/publication
    public function translations()
    {
        return $this->hasMany(ProjectTranslation::class);
    }
}
