<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PublicationCategory;
use App\Http\Controllers\Controller;

class PublicationCategoryController extends Controller
{
    public function index()
    {
        $categories = PublicationCategory::with('translations')->latest()->get();
        return view('admin.publication-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.publication-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
        ]);

        $category = PublicationCategory::create([
            'slug' => Str::slug($validated['translations']['en']['name']),
        ]);

        foreach ($validated['translations'] as $locale => $data) {
            $category->translations()->create(['locale' => $locale] + $data);
        }

        return redirect()->route('admin.publication-categories.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function edit(PublicationCategory $category)
    {
        $category->load('translations');
        return view('admin.publication-categories.edit', compact('category'));
    }

    public function update(Request $request, PublicationCategory $category)
    {
        $validated = $request->validate([
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
        ]);
        
        $category->update([
            'slug' => Str::slug($validated['translations']['en']['name']),
        ]);

        foreach ($validated['translations'] as $locale => $data) {
            $category->translations()->updateOrCreate(['locale' => $locale], $data);
        }

        return redirect()->route('admin.publication-categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(PublicationCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.publication-categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
