<?php

namespace App\View\Composers;

use App\Models\Service;
use Illuminate\View\View;

class NavbarComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // 1. Ambil semua data service beserta terjemahannya.
        $services = Service::query()
            ->with('translations')
            ->orderBy('created_at', 'asc')
            ->get();

        // 2. Kirim (bind) data tersebut ke view dengan nama variabel 'servicesForNavbar'
        $view->with('servicesForNavbar', $services);
    }
}