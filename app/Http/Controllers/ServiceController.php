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
                    ->orderBy('created_at', 'asc')
                    ->get();
        return view('pages.services.index', compact('services'));
    }

    public function show($locale, $slug)
    {

        // dd($slug);
        $service = Service::query()
                    ->where('slug', $slug)
                    ->with('translations')
                    ->firstOrFail();

        return view('pages.services.show', compact('service'));
    }
}
