@props(['faq'])

@php
    $translation = $faq->translations->firstWhere('locale', app()->getLocale());
@endphp

<div x-data="{ open: false }" class="border-b">
    <h2>
        <button type="button" @click="open = !open" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-700">
            <span>{{ $translation->question ?? 'Pertanyaan tidak tersedia' }}</span>
            <svg :class="{ 'rotate-180': open }" class="w-3 h-3 transform transition-transform duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
        </button>
    </h2>
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:leave="transition ease-in duration-150" class="py-5 border-t border-gray-200">
        <p class="text-gray-600">
            {!! nl2br(e($translation->answer ?? '')) !!}
        </p>
    </div>
</div>