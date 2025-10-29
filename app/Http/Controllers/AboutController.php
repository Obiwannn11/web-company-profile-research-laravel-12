<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Team;
use App\Models\SiteContent;
use Illuminate\Http\Request;
use App\Models\SettingTranslation;

class AboutController extends Controller
{

    public function company() 
    {

        //ambil bagian company dari site_contents
        $keys = ['company_name', 'company_focus', 'company_history'];
        $contents = SiteContent::whereIn('key', $keys)->with('translations')->get();

        $companySettings = $contents->mapWithKeys(function ($item) {
            $translation = $item->translations->firstWhere('locale', 'app()->getLocale()');
            return [str_replace('_', '.', $item->key) => $translation->value ?? ''];
        });

        return view('pages.about.company', compact('companySettings'));
    }

    public function team()
    {
        $teamMembers = Team::query()
                ->with('translations')
                ->orderBy('sort_order', 'asc')
                ->get();
        return view('pages.about.team', compact('teamMembers'));
    }

    public function faq()
    {
        $faqs = Faq::query()
                ->with('translations')
                ->orderBy('sort_order', 'asc')
                ->get();
        return view('pages.about.faq', compact('faqs'));
    }

    public function contact()
    {

        $contacts = SettingTranslation::query()
            ->where('locale', app()->getLocale())
            ->where('key', 'like', 'contact.%')
            ->pluck('value', 'key');

        $keys = ['contact_address', 'contact_email', 'contact_phone', 'contact_instagram_url', 'footer_name', 'footer_contact', 'footer_social_media'];
        
        $contents = SiteContent::whereIn('key', $keys)->with('translations')->get();

        $contactSettings = $contents->mapWithKeys(function ($item) {
            $translation = $item->translations->firstWhere('locale', app()->getLocale());
            return [$item->key => $translation->value ?? ''];
        });

        return view('pages.about.contact', compact('contacts', 'contactSettings'));
    }

}

