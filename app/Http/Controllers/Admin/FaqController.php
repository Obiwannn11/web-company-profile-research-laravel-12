<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('translations')->orderBy('sort_order', 'asc')->get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|accepted|string',
            'sort_order' => 'required|integer',
            'translations' => 'required|array',
            'translations.*.question' => 'required|string',
            'translations.*.answer' => 'required|string',
        ]);

        $faq = Faq::create([
            'name' => $validated['name'],
            'sort_order' => $validated['sort_order']
        ]);

        foreach ($validated['translations'] as $locale => $data) {
            $faq->translations()->create(['locale' => $locale] + $data);
        }

        return redirect()->route('admin.faq.index')->with('success', 'FAQ baru berhasil ditambahkan.');
    }

    public function edit(Faq $faq)
    {
        $faq->load('translations');
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'name' => 'nullable|accepted|string',
            'sort_order' => 'required|integer',
            'translations' => 'required|array',
            'translations.*.question' => 'required|string',
            'translations.*.answer' => 'required|string',
        ]);

        $faq->update(['sort_order' => $validated['sort_order']]);

        foreach ($validated['translations'] as $locale => $data) {
            $faq->translations()->updateOrCreate(['locale' => $locale], $data);
        }

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
