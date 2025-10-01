<?php

namespace App\Models;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ToolTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_id',
        'locale',
        'title',
        'description',
    ];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
}
