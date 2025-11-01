<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('translations')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
         $validated = $request->validate([
            // 'name' => 'string|max:255||nullable',
            'slug' => 'required|string|unique:services,slug|max:255',
            'hero_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string', // nullable jika deskripsi boleh kosong
            'translations.*.content' => 'nullable|string',
        ]);

        $imagePath = $request->file('hero_image')->store('services', 'public');
        $service = Service::create([
            // 'name' => $validated['name'],
            'slug' => $validated['slug'],
            'hero_image' => $imagePath,
        ]);

         foreach ($validated['translations'] as $locale => $data) {
            $service->translations()->create([
                'locale' => $locale,
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'content' => $data['content'] ?? null,
            ]);
        }

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit( Service $service)
    {
        $service->load('translations');

        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {

        // 1. Validasi data (mirip dengan store, tapi 'slug' harus unik kecuali untuk dirinya sendiri)
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:services,slug,' . $service->id,
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'translations.*.content' => 'nullable|string',
        ]);

        // 2. Update data utama di tabel 'services'
        $service->slug = $validated['slug'];

        // 3. Cek jika ada gambar baru yang di-upload
        if ($request->hasFile('hero_image')) {
            Storage::disk('public')->delete($service->hero_image);
            $service->hero_image = $request->file('hero_image')->store('services', 'public');
        }

        $service->save(); // Simpan perubahan pada service

        // 4. Loop dan update atau buat data terjemahan
        foreach ($validated['translations'] as $locale => $data) {
            $service->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                            'title' => $data['title'],
                            'description' => $data['description'] ?? null,
                            'content' => $data['content'] ?? null,
                        ]
            );
        }
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        Storage::disk('public')->delete($service->hero_image);

        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }


}
