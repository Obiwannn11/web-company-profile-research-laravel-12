{{-- x-data mendefinisikan "state" untuk komponen ini --}}
{{-- servicesOpen dan aboutOpen awalnya 'false' (tertutup) --}}
<header x-data="{ open: false, servicesOpen: false, aboutOpen: false, rndOpen: false, languageOpen: false }" class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('locale.home', ['locale' => app()->getLocale()]) }}" class="text-xl font-bold text-blue-600">
                {{ $navbarItem->get('navbar_name', 'ReadyLabss') }}
            </a>

            {{-- Menu Desktop --}}
            <div class="hidden md:flex items-center space-x-6">

                <a href="{{ route('locale.home', ['locale' => app()->getLocale()]) }}" class="text-gray-700 hover:text-blue-600">{{ $navbarItem->get('navbar_home', 'Homeee') }}</a>
                
                {{-- Dropdown Services --}}
                <div class="relative">
                    {{-- @click akan mengubah nilai servicesOpen saat tombol diklik --}}
                    <button @click="servicesOpen = !servicesOpen" class="flex items-center text-gray-700 hover:text-blue-600">
                        {{ $navbarItem->get('navbar_services', 'Serpis') }}
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    {{-- x-show membuat elemen ini hanya tampil jika servicesOpen adalah 'true' --}}
                    {{-- @click.away akan menutup menu jika mengklik di luar area ini --}}
                    <div x-show="servicesOpen" @click.away="servicesOpen = false" x-transition class="absolute mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20" style="display: none;">
                        @foreach ($servicesForNavbar as $service)
                            @php
                                $translation = $service->translations->firstWhere('locale', app()->getLocale());
                            @endphp
                            <a href="{{ route('locale.services.show', ['locale' => app()->getLocale(), 'slug' => $service->slug]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                {{ $translation->title ?? '' }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- <a href="{{ route('locale.rnd.projects', ['locale' => app()->getLocale()]) }}" class="text-gray-700 hover:text-blue-600">{{ $navbarItem->get('navbar_rnd', 'R&D Projectss') }}</a> --}}

                <div class="relative">
                    <button @click="rndOpen = !rndOpen" class="flex items-center text-gray-700 hover:text-blue-600">
                        {{ $navbarItem->get('navbar_rnd', 'Navbar RND') }}
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="rndOpen" @click.away="rndOpen = false" x-transition class="absolute mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20" style="display: none;">
                        <a href="{{ route('locale.rnd.research', ['locale' => app()->getLocale()]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Research</a>
                    <a href="{{ route('locale.rnd.projects', ['locale' => app()->getLocale()]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Projects</a>
                        <a href="{{ route('locale.rnd.publications', ['locale' => app()->getLocale()]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Publication</a>
                    </div>
                </div>

                <a href="{{ route('locale.tools.index', ['locale' => app()->getLocale()]) }}" class="text-gray-700 hover:text-blue-600">{{ $navbarItem->get('navbar_tools', 'Toools') }}</a>

                {{-- Dropdown About Us (statis) --}}
                <div class="relative">
                    <button @click="aboutOpen = !aboutOpen" class="flex items-center text-gray-700 hover:text-blue-600">
                        {{ $navbarItem->get('navbar_about_us', 'About Usss') }}
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="aboutOpen" @click.away="aboutOpen = false" x-transition class="absolute mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20" style="display: none;">
                        <a href="{{ route('locale.about.company', ['locale' => app()->getLocale()]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Company</a>
                        <a href="{{ route('locale.about.team', ['locale' => app()->getLocale()]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Team</a>
                        <a href="{{ route('locale.about.faq', ['locale' => app()->getLocale()]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">FAQ</a>
                    </div>
                </div>

                <a href="{{ route('locale.contact.index', ['locale' => app()->getLocale()]) }}" class="text-gray-700 hover:text-blue-600">{{ $navbarItem->get('navbar_contact_us', 'Contacts Uss') }}</a>

            </div>

            {{-- Language Switcher & Mobile Menu Button --}}
            <div class="flex items-center">
                <div class="hidden md:flex items-center space-x-2 mr-4 border border-gray-200 rounded-full p-1">
                    
                    @foreach ($languagePills as $pill)
                        <a href="{{ $pill->url }}"
                           class="px-3 py-1 text-sm font-semibold rounded-full transition-colors duration-200
                                  @if($pill->is_active)
                                      bg-blue-600 text-white shadow-md
                                  @else
                                      text-gray-600 hover:bg-gray-100
                                  @endif
                           ">
                            {{ $pill->name }} {{-- Tampil sebagai ID atau EN --}}
                        </a>
                    @endforeach

                </div>

                {{-- Tombol Hamburger untuk Mobile --}}
                <div class="md:hidden">
                    <button @click="open = !open">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>