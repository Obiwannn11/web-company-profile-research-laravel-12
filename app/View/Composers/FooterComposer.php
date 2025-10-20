<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\SiteContent;
use App\Models\SettingTranslation;

class FooterComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        //ambil elemen khusus untuk bagian footer
        $keys = ['contact_address', 'contact_email', 'contact_phone', 'contact_instagram_url', 'footer_name', 'footer_contact', 'footer_social_media'];
        
        $contents = SiteContent::whereIn('key', $keys)->with('translations')->get();

        $contactSettings = $contents->mapWithKeys(function ($item) {
            $translation = $item->translations->firstWhere('locale', app()->getLocale());
            return [$item->key => $translation->value ?? ''];
        });

        $view->with('contactSettings', $contactSettings);
    }
}