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
        $supportedLocales = [
            'id' => 'Indonesia',
            'en' => 'English',
        ];

        $currentLocale = app()->getLocale();
        $currentRouteName = request()->route() ? request()->route()->getName() : 'locale.home';
        $currentRouteParams = request()->route() ? request()->route()->parameters() : [];

        $languageSwitchUrls = [];
        foreach ($supportedLocales as $localeCode => $localeName) {
            // Jangan buat link untuk bahasa yang sedang aktif
            if ($localeCode === $currentLocale) continue;
            
            $currentRouteParams['locale'] = $localeCode;
            $languageSwitchUrls[$localeCode] = [
                'name' => $localeName,
                'url' => route($currentRouteName, $currentRouteParams)
            ];
        }
        
        $view->with([
            'servicesForNavbar' => $services,
            'navbarItem' => $navbarItem,
            'currentLocaleName' => $supportedLocales[$currentLocale] ?? strtoupper($currentLocale),
            'languageSwitchUrls' => $languageSwitchUrls,
        ]);
    }
}