<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

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

    public function publication()
    {
        $externalpublication = Project::query()
                        ->where('type', 'publication')
                        ->where('category', 'external')
                        ->with('translations')
                        ->orderBy('sort_order', 'asc')
                        ->get();
        $internalpublication = Project::query()
                        ->where('type', 'publication')
                        ->where('category', 'internal')
                        ->with('translations')
                        ->orderBy('sort_order', 'asc')
                        ->get();

        return view('pages.rnd.publication', compact('externalpublication', 'internalpublication'));
    }
    
}
