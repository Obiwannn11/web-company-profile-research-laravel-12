<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Carousel;
use App\Models\SiteContent;
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

        $carousels = Carousel::with('translations')
            ->orderBy('sort_order', 'asc')
            ->get();


        //ambil bagian hero dari site_contents
        $keys = ['hero_title', 'hero_subtitle', 'hero_button_text', 'home_services_title', 'home_services_subtitle', 'cta_title', 'cta_subtitle', 'cta_button_text'];
        $contents = SiteContent::whereIn('key', $keys)->with('translations')->get();

        $heroContent = $contents->mapWithKeys(function ($item) {
            $translation = $item->translations->firstWhere('locale', app()->getLocale());
            return [$item->key => $translation->value ?? ''];
        });

        return view('pages.home', compact('featuredServices', 'heroContent', 'carousels'));
    }
}
