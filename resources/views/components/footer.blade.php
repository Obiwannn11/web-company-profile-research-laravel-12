<footer class="bg-gray-800 text-white">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Bagian Alamat --}}
            <div>
                <h3 class="text-lg font-semibold">ReadyLab</h3>
                <p class="mt-4 text-gray-400">
                    {{-- {{ dd($contactSettings) }} --}}
                    {{ $contactSettings->get('contact_address', 'Alamat tidak tersedia.') }}
                </p>
            </div>

            {{-- Bagian Kontak --}}
            <div>
                <h3 class="text-lg font-semibold">Kontak</h3>
                <ul class="mt-4 space-y-2 text-gray-400">
                    <li>
                        Email: 
                        <a href="mailto:{{ $contactSettings->get('contact_email', '#') }}" class="hover:text-blue-400">
                            {{ $contactSettings->get('contact_email', 'Email tidak tersedia.') }}
                        </a>
                    </li>
                    <li>
                        Telepon: 
                        <a href="tel:{{ $contactSettings->get('contact_phone', '#') }}" class="hover:text-blue-400">
                            {{ $contactSettings->get('contact_phone', 'Telepon tidak tersedia.') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Bagian Sosial Media --}}
            <div>
                <h3 class="text-lg font-semibold">Ikuti Kami</h3>
                <div class="mt-4">
                    <a href="{{ $contactSettings->get('contact_instagram_url', '#') }}" target="_blank" class="text-gray-400 hover:text-blue-400">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c-4.09 0-7.39 3.3-7.39 7.39s3.3 7.39 7.39 7.39 7.39-3.3 7.39-7.39S16.405 2 12.315 2zm0 12.68c-2.93 0-5.3-2.37-5.3-5.3s2.37-5.3 5.3-5.3 5.3 2.37 5.3 5.3-2.37 5.3-5.3 5.3zm4.23-7.82c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1z" clip-rule="evenodd"/></svg>
                    </a>
                </div>
            </div>

        </div>
        
        <div class="mt-12 border-t border-gray-700 pt-8 text-center text-gray-500">
            &copy; {{ date('Y') }} ReadyLab. All Rights Reserved.
        </div>
    </div>
</footer>