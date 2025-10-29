@extends('layouts.app')

@section('title', $pageContent->get('rnd_project_title', 'R&D Projects') . ' - ReadyLab') {{-- Dynamic Title --}}

@section('content')
    <div class="container mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                {{ $pageContent->get('rnd_project_title', 'Proyek Research & Developmengggg') }}</h1>
            <p class="mt-4 text-lg text-gray-600">
                {{ $pageContent->get('rnd_project_subtitle', 'Jelajahi proyek inovatiffff yang kami kerjakan, baik secara internallll maupun untuk klien eksternal.') }}
            </p>
        </div>

        {{-- Section Eksternal --}}
        @if ($externalProjects->isNotEmpty())
            <div x-data="{ activeTab: '{{ $externalProjects->first()->id }}' }" class="mt-10">
                <h2 class="text-2xl font-semibold mb-4">{{ $pageContent->get('rnd_project_eksternal', 'Proyek Eksternallslslsl') }}</h2>
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="w-full md:w-1/3">
                        <ul class="space-y-2">
                            @foreach ($externalProjects as $project)
                                @php($translation = $project->translations->firstWhere('locale', app()->getLocale()))
                                <li>
                                    <button @click="activeTab = '{{ $project->id }}'"
                                        :class="activeTab === '{{ $project->id }}' ? 'bg-blue-600 text-white' :
                                            'bg-gray-100 hover:bg-gray-200'"
                                        class="w-full text-left p-4 rounded-md transition-colors duration-200">
                                        {{ $translation->title ?? 'Judul tidak tersedia' }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="w-full md:w-2/3">
                        @foreach ($externalProjects as $project)
                            @php($translation = $project->translations->firstWhere('locale', app()->getLocale()))
                            <div x-show="activeTab === '{{ $project->id }}'" x-transition>
                                <div class="flex items-start gap-4">
                                    <div>
                                        <h3 class="text-xl font-bold">{{ $translation->title ?? '' }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">{{ $translation->details ?? '' }}</p>
                                    </div>
                                    <img src="{{ asset('storage/' . $project->icon_image) }}" alt="Icon"
                                        class="w-16 h-16 object-cover">
                                </div>
                                <div class="mt-4 border-t pt-4 text-gray-600">
                                    {!! nl2br(e($translation->description ?? '')) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($internalProjects->isNotEmpty())
            <div x-data="{ activeTab: '{{ $internalProjects->first()->id }}' }" class="mt-10">
                <h2 class="text-2xl font-semibold mb-4">{{ $pageContent->get('rnd_project_internal', 'Proyek Internnnnal') }}</h2>
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="w-full md:w-1/3">
                        <ul class="space-y-2">
                            @foreach ($internalProjects as $project)
                                @php($translation = $project->translations->firstWhere('locale', app()->getLocale()))
                                <li>
                                    <button @click="activeTab = '{{ $project->id }}'"
                                        :class="activeTab === '{{ $project->id }}' ? 'bg-blue-600 text-white' :
                                            'bg-gray-100 hover:bg-gray-200'"
                                        class="w-full text-left p-4 rounded-md transition-colors duration-200">
                                        {{ $translation->title ?? 'Judul tidak tersedia' }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="w-full md:w-2/3">
                        @foreach ($internalProjects as $project)
                            @php($translation = $project->translations->firstWhere('locale', app()->getLocale()))
                            <div x-show="activeTab === '{{ $project->id }}'" x-transition>
                                <div class="flex items-start gap-4">
                                    <div>
                                        <h3 class="text-xl font-bold">{{ $translation->title ?? '' }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">{{ $translation->details ?? '' }}</p>
                                    </div>
                                    <img src="{{ asset('storage/' . $project->icon_image) }}" alt="Icon"
                                        class="w-16 h-16 object-cover">
                                </div>
                                <div class="mt-4 border-t pt-4 text-gray-600">
                                    {!! nl2br(e($translation->description ?? '')) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
