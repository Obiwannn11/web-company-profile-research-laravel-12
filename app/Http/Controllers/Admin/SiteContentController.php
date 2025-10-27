<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SiteContentTranslation;

class SiteContentController extends Controller
{
    public function index() {
        $contents = SiteContent::with('translations')->get();
        // Ubah data agar mudah diakses di view
        $settings = [];
        foreach ($contents as $content) {
            $translationsForKey = []; // array kosong untuk menampung key translation
            
            foreach ($content->translations as $translation) { // Loop untuk smua bahasa berdasarkan isi translationnya
                $translationsForKey[$translation->locale] = $translation->value ?? ''; // menggunakan locale ('id','en',dll) sebagai key arrya
            }

            $settings[$content->key] = $translationsForKey; // Simpan semua terjemahan untuk key ini ke dalam array $settings
        }

        // mencari unik di locale 
        $supportedLocales = SiteContentTranslation::distinct()
                            ->pluck('locale') // Ambil hanya kolom 'locale'
                            ->toArray(); // Ubah menjadi array biasa
        //                  ->orderBy('locale') // Urutkan (opsional, tapi rapi)

        // Jika tidak ada data sama sekali, pastikan minimal ada default locale
        if (empty($supportedLocales)) {
            $supportedLocales = ['id', 'en']; // Atau ambil dari config('app.fallback_locale')
        }
        
        return view('admin.settings.index', compact('settings', 'supportedLocales'));
    }

    public function update(Request $request) {
        $validated = $request->validate(['contents' => 'required|array']);

        foreach ($validated['contents'] as $key => $translations) {
            $content = SiteContent::where('key', $key)->first();
            if ($content) {
                foreach ($translations as $locale => $value) {
                    $content->translations()->updateOrCreate(
                        ['locale' => $locale],
                        ['value' => $value ?? '']
                    );
                }
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
