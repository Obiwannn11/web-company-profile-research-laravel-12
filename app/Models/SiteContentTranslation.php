<?php

namespace App\Models;

use App\Models\SiteContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteContentTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['site_content_id', 'locale', 'value'];
    public $timestamps = false; // Tabel ini tidak perlu timestamps

    public function siteContent()
    {
        return $this->belongsTo(SiteContent::class);
    }
}
