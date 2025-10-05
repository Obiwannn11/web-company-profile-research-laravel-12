<?php

namespace App\View\Composers;

use App\Models\SettingTranslation;
use Illuminate\View\View;

class FooterComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Ambil semua data setting yang berawalan 'contact.' untuk locale saat ini
        $contactSettings = SettingTranslation::query()
            ->where('locale', app()->getLocale())
            ->where('key', 'like', 'contact.%')
            ->pluck('value', 'key'); // Mengubah hasil menjadi array ['key' => 'value']

        // Kirim data ke view dengan nama variabel 'contactSettings'
        $view->with('contactSettings', $contactSettings);
    }
}