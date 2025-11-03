<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    
    public function index()
    {
        $carousels = Carousel::with('translations')->orderBy('sort_order', 'asc')->get();
        return view('admin.carousels.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048',
            'link_url' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
            'translations' => 'required|array',
            'translations.*.title' => 'nullable|string|max:255',
            'translations.*.subtitle' => 'nullable|string',
            'translations.*.button_text' => 'nullable|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('carousels', 'public');

        $carousel = Carousel::create([
            'image' => $imagePath,
            'link_url' => $validated['link_url'],
            'sort_order' => $validated['sort_order'],
        ]);

        foreach ($validated['translations'] as $locale => $data) {
            $carousel->translations()->create(['locale' => $locale] + $data);
        }

        return redirect()->route('admin.carousels.index')->with('success', 'Slide carousel baru ditambahkan.');
    }

    public function edit(Carousel $carousel)
    {
        $carousel->load('translations');
        return view('admin.carousels.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
         $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'link_url' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
            'translations' => 'required|array',
            'translations.*.title' => 'nullable|string|max:255',
            'translations.*.subtitle' => 'nullable|string',
            'translations.*.button_text' => 'nullable|string|max:255',
        ]);

        $carousel->link_url = $validated['link_url'];
        $carousel->sort_order = $validated['sort_order'];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($carousel->image);
            $carousel->image = $request->file('image')->store('carousels', 'public');
        }

        $carousel->save();

        foreach ($validated['translations'] as $locale => $data) {
            $carousel->translations()->updateOrCreate(['locale' => $locale], $data);
        }

        return redirect()->route('admin.carousels.index')->with('success', 'Slide carousel diperbarui.');
    }

    public function destroy(Carousel $carousel)
    {
        Storage::disk('public')->delete($carousel->image);
        $carousel->delete();
        return redirect()->route('admin.carousels.index')->with('success', 'Slide carousel dihapus.');
    }
}
