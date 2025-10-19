<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('translations')->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
            'category' => 'required',
            'image' => 'image|max:2048',
            'sort_order' => 'required|integer',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.details' => 'required|string',
            'translations.*.description' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('projects', 'public');

        $project = Project::create([
            'type' => $validated['type'],
            'category' => $validated['category'],
            'image' => $imagePath,
            'sort_order' => $validated['sort_order'],
        ]);

        foreach ($validated['translations'] as $locale => $data) {
            $project->translations()->create(['locale' => $locale] + $data);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Item R&D baru berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        $project->load('translations');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
            'category' => 'required',
            'image' => 'image|max:2048',
            'sort_order' => 'required|integer',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:255',
            'translations.*.details' => 'required|string',
            'translations.*.description' => 'required|string',
        ]);

        $project->fill($validated);


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $project->update(['image' => $imagePath]);
        }

        $project->save();

        foreach ($validated['translations'] as $locale => $data) {
            $project->translations()->updateOrCreate(
                ['locale' => $locale],
                $data
            );
        }

        return redirect()->route('admin.projects.index')->with('success', 'Item R&D berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        Storage::disk('public')->delete($project->icon_image);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Item R&D berhasil dihapus.');
    }
}
