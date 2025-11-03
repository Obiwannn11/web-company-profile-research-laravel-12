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
            'en' => 'English'
        ];
        $currentLocale = app()->getLocale();
        $currentRouteName = request()->route() ? request()->route()->getName() : 'locale.home';
        $currentRouteParams = request()->route() ? request()->route()->parameters() : [];
        
        $languagePills = [];

        foreach ($supportedLocales as $localeCode => $localeName) {
            $isActive = ($localeCode === $currentLocale);
            // Siapkan parameter untuk URL
            $routeParams = $currentRouteParams;
            $routeParams['locale'] = $localeCode;

            $languagePills[] = (object)[
                'code' => $localeCode,
                'name' => strtoupper($localeCode), // Menampilkan "ID" atau "EN"
                'url' => route($currentRouteName, $routeParams),
                'is_active' => $isActive,
            ];
        }
        
        $view->with([
            'servicesForNavbar' => $services,
            'navbarItem' => $navbarItem,
            'languagePills' => $languagePills,
        ]);
    }
}