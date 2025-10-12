<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('translations')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        return view('admin.services.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }


}
