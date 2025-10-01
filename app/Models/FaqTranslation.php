<?php

namespace App\Models;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'faq_id',
        'locale',
        'question',
        'answer',
    ];

    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
