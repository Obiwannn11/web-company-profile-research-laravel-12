<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'locale', 'title', 'details', 'description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
