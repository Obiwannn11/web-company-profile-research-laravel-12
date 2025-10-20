<?php

namespace App\View\Composers;

use App\Models\Service;
use Illuminate\View\View;
use App\Models\SiteContent;

class NavbarComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {

        //ambil elemen khusus untuk bagian navbar
        $keys = ['navbar_name', 'navbar_home', 'navbar_services', 'navbar_rnd', 'navbar_tools', 'navbar_about_us', 'navbar_contact_us'];

        $contents = SiteContent::whereIn('key', $keys)->with('translations')->get();

        $navbarItem = $contents->mapWithKeys(function ($item) {
            $translation = $item->translations->firstWhere('locale', app()->getLocale());
            return [$item->key => $translation->value ?? ''];
        });


        
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
            'languageSwitchUrl' => $languageSwitchUrl,
            'navbarItem' => $navbarItem,
        ]);
    }
}