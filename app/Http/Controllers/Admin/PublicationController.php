<?php

namespace App\Http\Controllers\Admin;

use App\Models\Publication;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PublicationCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function index()
    {
        // Eager load relasi 'category' dan 'translations'
        $publications = Publication::with('category.translations', 'translations')->latest()->get();
        return view('admin.publications.index', compact('publications'));
    }

    public function create()
    {
        // Ambil semua kategori untuk ditampilkan di dropdown form
        $categories = PublicationCategory::with('translations')->get();
        return view('admin.publications.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'publication_category_id' => 'required|exists:publication_categories,id',
            'hero_image' => 'required|image|max:2048',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'required|string',
            'translations.*.description' => 'string',
        ]);

        $imagePath = $request->file('hero_image')->store('publications', 'public');

        $publication = Publication::create([
            'publication_category_id' => $validated['publication_category_id'],
            'hero_image' => $imagePath,
            'slug' => Str::slug($validated['translations']['en']['title']),
        ]);

        foreach ($validated['translations'] as $locale => $data) {
            $publication->translations()->create(['locale' => $locale] + $data);
        }

        return redirect()->route('admin.publications.index')->with('success', 'Publikasi baru berhasil ditambahkan.');
    }


    public function edit(Publication $publication)
    {
        $publication->load('translations');
        $categories = PublicationCategory::with('translations')->get();
        return view('admin.publications.edit', compact('publication', 'categories'));
    }

    public function update(Request $request, Publication $publication)
    {
        $validated = $request->validate([
            'publication_category_id' => 'required|exists:publication_categories,id',
            'hero_image' => 'nullable|image|max:2048',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.content' => 'required|string',
            'translations.*.description' => 'string',
        ]);

        $publication->publication_category_id = $validated['publication_category_id'];
        $publication->slug = Str::slug($validated['translations']['en']['title']);

        if ($request->hasFile('hero_image')) {
            Storage::disk('public')->delete($publication->hero_image);
            $publication->hero_image = $request->file('hero_image')->store('publications', 'public');
        }

        $publication->save();

        foreach ($validated['translations'] as $locale => $data) {
            $publication->translations()->updateOrCreate(['locale' => $locale], $data);
        }

        return redirect()->route('admin.publications.index')->with('success', 'Publikasi berhasil diperbarui.');
    }

    public function destroy(Publication $publication)
    {
        Storage::disk('public')->delete($publication->hero_image);
        $publication->delete();
        return redirect()->route('admin.publications.index')->with('success', 'Publikasi berhasil dihapus.');
    }

}
