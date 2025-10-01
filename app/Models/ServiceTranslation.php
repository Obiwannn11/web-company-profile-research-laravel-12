<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['service_id', 'locale', 'title', 'description', 'content']; 

    public function service()
    {
        return $this->belongsTo(Service::class);   
    }
}
