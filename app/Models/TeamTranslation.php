<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'locale',
        'name',
        'position',
        'expertise',
        'details',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
