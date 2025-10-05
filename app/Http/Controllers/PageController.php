<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {

         // Ambil 3 layanan pertama yang dibuat, beserta terjemahannya
        $featuredServices = Service::query()
            ->with('translations')
            ->orderBy('created_at', 'asc')
            ->limit(3)
            ->get();

        return route('locale.home', compact('featuredServices'));
    }
}
