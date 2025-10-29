<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    
    public function index()
    {

        $keys = ['tools_title', 'tools_subtitle'];
        $contents = SiteContent::whereIn('key', $keys)->with('translations')->get();

        $pageContent = $contents->mapWithKeys(function ($item) {
            $translation = $item->translations->firstWhere('locale', 'app()->getLocale()');
            return [str_replace('_', '.', $item->key) => $translation->value ?? ''];
        });

        $tools = Tool::query()
        ->with('translations')
        ->orderBy('created_at', 'asc')
        ->get();
        return view('pages.tools.index', compact('tools', 'pageContent'));
    }
}
