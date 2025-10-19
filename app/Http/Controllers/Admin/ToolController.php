<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::query()
            ->with('translations')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        return view('admin.tools.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'logo_image' => 'nullable|image',
            'video_url' => 'nullable|url',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.description' => 'required|string',

        ]);

        $imagePath = $request->file('logo_image')->store('tools', 'public');

        // Simpan data utama (dari input ID) ke tabel 'tools'
        $tool = Tool::create([
            'name' => $validated['translations']['id']['title'],
            'description' => $validated['translations']['id']['description'],
            'logo_image' => $imagePath,
            'video_url' => $validated['video_url'],
        ]);

        // Gunakan LOOPING untuk menyimpan semua terjemahan lainnya
        foreach ($validated['translations'] as $locale => $data) {
            // // Lewati 'id' karena sudah disimpan di atas
            // if ($locale == 'id') {
            //     continue;
            // }

            // Simpan terjemahan untuk locale  (en, fr, dll)
            $tool->translations()->create([
                'locale' => $locale,
                'title' => $data['title'],
                'description' => $data['description'],
            ]);

        }
        return redirect()->route('admin.tools.index')->with('success', 'Tool baru berhasil ditambahkan.');
    }

    public function edit(Tool $tool)
    {
        $tool->load('translations');
        return view('admin.tools.edit', compact('tool'));
    }

    public function update(Request $request, Tool $tool)
    {
        $validated = $request->validate([
            'logo_image' => 'nullable|image',
            'video_url' => 'nullable|url',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.description' => 'required|string',
        ]);

        //data utama (dari input ID) di tabel 'tools'
        $tool->name = $validated['translations']['id']['title'];
        $tool->description = $validated['translations']['id']['description'];
        $tool->video_url = $validated['video_url'];

        if ($request->hasFile('logo_image')) {
            Storage::disk('public')->delete($tool->logo_image);
            $tool->logo_image = $request->file('logo_image')->store('tools', 'public');
        }

        $tool->save();

        // LOOPING untuk mengupdate semua terjemahan lainnya
        foreach ($validated['translations'] as $locale => $data) {
            // Lewati 'id' karena sudah diupdate di atas
            // if ($locale == 'id') {
            //     continue;
            // }

            // Update atau buat terjemahan untuk locale  (en, fr, dll)
            $tool->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $data['title'],
                    'description' => $data['description'],
                ]
            );
        }

        return redirect()->route('admin.tools.index')->with('success', 'Data tool berhasil diperbarui.');
    }

    public function destroy(Tool $tool)
    {
        Storage::disk('public')->delete($tool->logo_image);
        $tool->delete();
        return redirect()->route('admin.tools.index')->with('success', 'Tool berhasil dihapus.');
    }
}
