<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteContentController extends Controller
{
    public function index() {
        $contents = SiteContent::with('translations')->get();
        // Ubah data agar mudah diakses di view
        $settings = [];
        foreach ($contents as $content) {
            $settings[$content->key] = [
                'id' => $content->translations->firstWhere('locale', 'id')->value ?? '',
                'en' => $content->translations->firstWhere('locale', 'en')->value ?? '',
            ];
        }
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request) {
        $validated = $request->validate(['contents' => 'required|array']);

        foreach ($validated['contents'] as $key => $translations) {
            $content = SiteContent::where('key', $key)->first();
            if ($content) {
                foreach ($translations as $locale => $value) {
                    $content->translations()->updateOrCreate(
                        ['locale' => $locale],
                        ['value' => $value]
                    );
                }
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
