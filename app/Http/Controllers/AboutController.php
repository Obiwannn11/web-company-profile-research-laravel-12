<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\SettingTranslation;

class AboutController extends Controller
{

    public function company() 
    {
        $company = SettingTranslation::query()
                    ->where('locale', app()->getLocale())
                    ->where('key', 'like', 'company.%')
                    ->pluck('value', 'key');
        return route('locale.about.company', compact('company'));
    }

    public function team()
    {
        $teams = Team::query()
                ->with('translations')
                ->orderBy('sort_order', 'asc')
                ->get();
        return route('locale.about.team', compact('teams'));
    }

    public function faq()
    {
        $faqs = Faq::query()
                ->with('translations')
                ->orderBy('sort_order', 'asc')
                ->get();
        return route('locale.about.faq', compact('faqs'));
    }

    public function contact()
    {
        $contacts = SettingTranslation::query()
            ->where('locale', app()->getLocale())
            ->where('key', 'like', 'contact.%')
            ->pluck('value', 'key');

        return route('locale.contact.index', compact('contacts'));
    }

}

