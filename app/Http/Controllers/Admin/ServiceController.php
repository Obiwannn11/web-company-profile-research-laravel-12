<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'slug' => 'required|string|unique:services,slug|max:255',
            'hero_image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'translations' => 'required|array',
            'translations.id.title' => 'required|string|max:255',
            'translations.id.description' => 'string',
            'translations.id.content' => 'string',
            'translations.en.title' => 'required|string|max:255',
            'translations.en.description' => 'string',
            'translations.en.content' => 'string',
        ]);

        $imagePath = $request->file('hero_image')->store('services', 'public');
        $service = Service::create([
            'slug' => $validated['slug'],
            'hero_image' => $imagePath,
        ]);

         foreach ($validated['translations'] as $locale => $data) {
            $service->translations()->create([
                'locale' => $locale,
                'title' => $data['title'],
                'description' => $data['description'],
                'content' => $data['content'],
            ]);
        }

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        return view('admin.services.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }


}
