<?php

namespace App\View\Composers;

use App\Models\Service;
use Illuminate\View\View;

class NavbarComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $services = Service::query()->with('translations')->orderBy('created_at', 'asc')->get();

        $currentLocale = app()->getLocale();
        $targetLocale = ($currentLocale == 'id') ? 'en' : 'id';
        
        // Cek apakah route saat ini ada
        if (request()->route()) {
            $currentRouteName = request()->route()->getName();
            $currentRouteParams = request()->route()->parameters();
        
            // Ganti locale di dalam array parameter
            $currentRouteParams['locale'] = $targetLocale;

            // Baru buat URL dengan parameter yang sudah diubah
            $languageSwitchUrl = route($currentRouteName, $currentRouteParams);
        } else {
            // default route
            $languageSwitchUrl = route('locale.home', ['locale' => $targetLocale]);
        }
        
        $view->with([
            'servicesForNavbar' => $services,
            'currentLocale' => $currentLocale,
            'targetLocale' => $targetLocale,
            'languageSwitchUrl' => $languageSwitchUrl
        ]);
    }
}