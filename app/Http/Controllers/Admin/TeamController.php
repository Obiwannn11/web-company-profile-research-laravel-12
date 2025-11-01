<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Container\Attributes\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('translations')->orderBy('sort_order', 'asc')->get();
        return view('admin.team.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'name' => 'string|max:255||nullable',
            'photo' => 'required|image|max:5012',
            'sort_order' => 'required|integer',
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.position' => 'required|string|max:255',
            'translations.*.expertise' => 'required|string',
            'translations.*.details' => 'required|string',
        ]);

        $imagePath = $request->file('photo')->store('teams', 'public');
        $team = Team::create([
            // 'name' => $validated['name'],
            'photo' => $imagePath,
            'sort_order' => $validated['sort_order'],
        ]);

        foreach($validated['translations'] as $locale => $data) {
            $team->translations()->create(['locale' => $locale] + $data);
        }

        return redirect()->route('admin.team.index')->with('success', 'Team member created successfully.');
    }

    public function edit(Team $team)
    {
        $team->load('translations');
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'photo' => 'nullable|image',
            'sort_order' => 'required|integer',
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.position' => 'required|string|max:255',
            'translations.*.expertise' => 'required|string',
            'translations.*.details' => 'required|string',
        ]);

        $team->sort_order = $validated['sort_order'];
        if($request->hasFile('photo')) {
            Storage::disk('public')->delete($team->photo);
            $team->photo = $request->file('photo')->store('teams', 'public');
        }

        $team->save();

        foreach($validated['translations'] as $locale => $data) {
            $team->translations()->updateOrCreate(['locale' => $locale], $data);
        }

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');

    }


    public function destroy(Team $team)
    {
        Storage::disk('public')->delete($team->photo);
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }
}
