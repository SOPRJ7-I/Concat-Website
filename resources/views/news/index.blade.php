<x-layout>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Nieuwsbrieven</h1>
      @auth
            @if(auth()->user()->role === 'admin')
        <div class="mb-6">
            <a href="{{ route('news.create') }}"
               dusk="nieuwsbrief-toevoegen"
                    class="inline-flex items-center bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-green-600 transition"               
                    aria-label="Nieuwe nieuwsbrief toevoegen">
                Nieuwsbrief toevoegen
            </a>
        </div>
            @endif
        @endauth
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded" role="status">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-3 gap-6">
            {{-- Lijst van nieuwsbrieven --}}
            <div class="col-span-1 space-y-4" aria-label="Nieuwsbrief lijst">
                @forelse ($newsletters as $newsletter)
                    <div class="bg-gray-100 p-3 rounded" role="group" aria-label="Nieuwsbrief {{ $newsletter->titel }}">
                        <div class="mb-2">
                            <strong>{{ $newsletter->titel }}</strong><br>
                            <span class="text-sm text-gray-600">{{ $newsletter->publicatiedatum }}</span>
                        </div>

                        <div class="flex space-x-2">
                            <button
                                onclick="previewPDF('{{ asset('storage/' . $newsletter->pdf) }}')"
                                dusk="bekijk-newsletter"
                                class="text-blue-600 hover:underline text-sm"
                                aria-label="Bekijk PDF van {{ $newsletter->titel }}"
                            >
                                Bekijk
                            </button>

                            <a
                                href="{{ asset('storage/' . $newsletter->pdf) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-green-600 hover:underline text-sm"
                                aria-label="Open PDF van {{ $newsletter->titel }} in nieuw tabblad"
                            >
                                Open in nieuw tabblad
                            </a>

                            <a
                                href="{{ asset('storage/' . $newsletter->pdf) }}"
                                download
                                class="text-purple-600 hover:underline text-sm"
                                aria-label="Download PDF van {{ $newsletter->titel }}"
                            >
                                Download
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600" aria-live="polite">Er zijn momenteel geen nieuwsbrief beschikbaar.</p>
                @endforelse

                <div class="mt-6">
                    {{ $newsletters->links() }}
                </div>
            </div>

            {{-- PDF Preview --}}
            <div class="col-span-2" aria-label="PDF Voorvertoning">
                <iframe
                    id="pdfPreview"
                    src=""
                    title="Voorvertoning van de nieuwsbrief PDF"
                    class="w-full h-[600px] border border-gray-300 rounded"
                    style="display: none;"
                ></iframe>
                <p id="noPreview" class="text-gray-500">Klik op een nieuwsbrief om de PDF te bekijken.</p>
            </div>
        </div>
    </div>

    <script>
        function previewPDF(url) {
            document.getElementById('pdfPreview').style.display = 'block';
            document.getElementById('pdfPreview').src = url;
            document.getElementById('noPreview').style.display = 'none';
        }
    </script>
</x-layout>
