<header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-blue-600">
    {{-- Tombol hamburger untuk mobile --}}
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    {{-- Dropdown Profil Pengguna --}}
    <div x-data="{ dropdownOpen: false }" class="relative">
        <button @click="dropdownOpen = !dropdownOpen" class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
            {{-- Ganti dengan foto profil atau inisial --}}
            <span class="flex items-center justify-center h-full w-full bg-gray-300 text-gray-700">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
        </button>

        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10" style="display: none;">
            {{-- Tombol Logout --}}
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-600 hover:text-white">Logout</button>
            </form>
        </div>
    </div>
</header>