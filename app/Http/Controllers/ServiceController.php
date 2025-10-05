<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::query()
                    ->with('translations')
                    ->orderBy('sort_order', 'asc')
                    ->get();
        return route('locale.services.index', compact('services'));
    }

    public function show($slug)
    {
        $services = Service::query()
                    ->where('slug', $slug)
                    ->with('translations')
                    ->firstOrFail();

        return route('locale.services.show', compact('services'));
    }
}
