<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Publication;
use Illuminate\Http\Request;
use App\Models\PublicationCategory;

class RndController extends Controller
{
    public function projects()
    {
        $externalProjects = Project::query()
                        ->where('type', 'project')
                        ->where('category', 'external')
                        ->with('translations')
                        ->orderBy('sort_order', 'asc')
                        ->get();
        $internalProjects = Project::query()
                        ->where('type', 'project')
                        ->where('category', 'internal')
                        ->with('translations')
                        ->orderBy('sort_order', 'asc')
                        ->get();

        return view('pages.rnd.projects', compact('externalProjects', 'internalProjects'));
    }

    public function research()
    {
        $externalResearch = Project::query()
                        ->where('type', 'research')
                        ->where('category', 'external')
                        ->with('translations')
                        ->orderBy('sort_order', 'asc')
                        ->get();
        $internalResearch = Project::query()
                        ->where('type', 'research')
                        ->where('category', 'internal')
                        ->with('translations')
                        ->orderBy('sort_order', 'asc')
                        ->get();

        return view('pages.rnd.research', compact('externalResearch', 'internalResearch'));
    }

    public function publications(Request $request)
    {

        $categories = PublicationCategory::query()->with('translations')->get();

        $publicationsQuery = Publication::query()->with(['translations', 'category.translations']);
        
        if ($request->filled('category')) {
            // Filter berdasarkan slug kategori
            $publicationsQuery->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        $publications = $publicationsQuery->latest()->get();

        return view('pages.rnd.publications', compact('categories', 'publications'));
    }
    
}
