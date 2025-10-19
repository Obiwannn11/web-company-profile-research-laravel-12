{{-- Latar belakang gelap untuk overlay di mobile --}}
<div x-show="sidebarOpen" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>

{{-- Sidebar --}}
<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto bg-gray-800 text-white transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-semibold">ReadyLab Admin</a>
    </div>

    <nav class="mt-10">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700">
            <span class="mx-3">Dashboard</span>
        </a>
        <a href="{{ route('admin.services.index') }}"
            class="flex items-center px-6 py-2 mt-4 text-gray-100 hover:bg-gray-600 {{ request()->routeIs('admin.services.*') ? 'bg-gray-700' : '' }}">
            <span class="mx-3">Kelola Layanan</span>
        </a>

        <a href="{{ route('admin.team.index') }}"
            class="flex items-center px-6 py-2 mt-4 text-gray-100 hover:bg-gray-600 {{ request()->routeIs('admin.team.*') ? 'bg-gray-700' : '' }}">
            <span class="mx-3">Kelola Tim</span>
        </a>

        <a href="{{ route('admin.projects.index') }}"
            class="flex items-center px-6 py-2 mt-4 text-gray-100 hover:bg-gray-600 {{ request()->routeIs('admin.projects.*') ? 'bg-gray-700 bg-opacity-75' : '' }}">
            <span class="mx-3">Kelola R&D</span>
        </a>

        <a href="{{ route('admin.faq.index') }}"
            class="flex items-center px-6 py-2 mt-4 text-gray-100 hover:bg-gray-600 {{ request()->routeIs('admin.faq.*') ? 'bg-gray-700 bg-opacity-75' : '' }}">
            <span class="mx-3">Kelola FAQ</span>
        </a>

        <a href="{{ route('admin.tools.index') }}"
            class="flex items-center px-6 py-2 mt-4 text-gray-100 hover:bg-gray-600 {{ request()->routeIs('admin.tools.*') ? 'bg-gray-700 bg-opacity-75' : '' }}">
            <span class="mx-3">Kelola Tools</span>
        </a>

        <a href="{{ route('admin.publication-categories.index') }}"
            class="flex items-center px-6 py-2 mt-4 text-gray-100 hover:bg-gray-600 {{ request()->routeIs('admin.publication-categories.*') ? 'bg-gray-700 bg-opacity-75' : '' }}">
            <span class="mx-3">Kelola Kategori Publikasi</span>
        </a>

        <a href="{{ route('admin.publications.index') }}" class="flex items-center px-6 py-2 mt-4 text-gray-100 hover:bg-gray-600 {{ request()->routeIs('admin.publications.*') ? 'bg-gray-700 bg-opacity-75' : '' }}">
        <span class="mx-3">Kelola Publikasi</span>
    </a>

    <a href="{{ route('admin.settings.index') }}" class="flex items-center px-6 py-2 mt-4 text-gray-100 hover:bg-gray-600 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700 bg-opacity-75' : '' }}">
        <span class="mx-3">Pengaturan Situs</span>
    </a>
    
    </nav>
</div>
