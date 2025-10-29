<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Publication;
use App\Models\SiteContent;
use Illuminate\Http\Request;
use App\Models\PublicationCategory;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class RndController extends Controller
{
    public function getSiteContent(array $keys): Collection
    {
        $contents = SiteContent::whereIn('key', $keys)->with('translations')->get();
        
        return $contents->mapWithKeys(function ($item) {
            $translation = $item->translations->firstWhere('locale', app()->getLocale());
            return [$item->key => $translation->value ?? ''];
        });
    }

    public function projects(): View
    {

        $pageContent = $this->getSiteContent(['rnd_project_title', 'rnd_project_subtitle', 'rnd_project_internal', 'rnd_project_external']);

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


        return view('pages.rnd.projects', compact('externalProjects', 'internalProjects', 'pageContent'));
    }

    public function research()
    {
        $pageContent = $this->getSiteContent(['rnd_research_title', 'rnd_research_subtitle', 'rnd_research_internal', 'rnd_research_external']);
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

        return view('pages.rnd.research', compact('externalResearch', 'internalResearch', 'pageContent'));
    }

    public function publications(Request $request)
    {

        $pageContent = $this->getSiteContent(['rnd_publication_title', 'rnd_publication_subtitle']);

        $categories = PublicationCategory::query()->with('translations')->get();

        $publicationsQuery = Publication::query()->with(['translations', 'category.translations']);
        
        if ($request->filled('category')) {
            // Filter berdasarkan slug kategori
            $publicationsQuery->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        $publications = $publicationsQuery->latest()->get();

        return view('pages.rnd.publications', compact('categories', 'publications', 'pageContent'));
    }

    public function showPublication(string $locale,string $slug)
    {
        $publication = Publication::where('slug', $slug)
            ->with(['translations', 'category.translations']) // Eager load relasi
            ->firstOrFail(); // Otomatis 404 jika tidak ketemu

        return view('pages.rnd.publication-show', compact('publication'));
    }
    
}
