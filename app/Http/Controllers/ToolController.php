<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    
    public function index()
    {

        $tools = Tool::query()
        ->with('translations')
        ->orderBy('created_at', 'asc')
        ->get();
        return route('locale.tools.index', compact('tools'));
    }
}
