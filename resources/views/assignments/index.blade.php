<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">

        @if(session('success'))
            <div class="w-full flex justify-center">
                <div class="max-w-md p-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1 text-center w-full mb-6">
            Beschikbare Opdrachten
        </h1>

        @auth
            @if(auth()->user()->role === 'admin') {{-- Adjust role check as needed --}}
                <div class="flex justify-end my-4">
                    <a href="{{ route('assignments.create') }}"
                       class="inline-flex items-center bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-green-600 transition"
                       aria-label="Nieuwe opdracht toevoegen">
                        <i class="fa-solid fa-plus mr-2" aria-hidden="true"></i> Opdracht Toevoegen
                    </a>
                </div>
            @endif
        @endauth

        @if($assignments->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($assignments as $assignment)
                    <div class="bg-purple-50 border border-purple-200 p-4 rounded-lg shadow-sm transition-shadow duration-200">
                        <h2 class="text-xl font-bold text-purple-700 mb-1">{{ $assignment->title }}</h2>
                        <p class="text-gray-600 mb-1">
                            <span class="font-semibold">Bedrijf:</span> {{ $assignment->company_name }}
                        </p>
                        <p class="text-gray-600 mb-2">
                            <span class="font-semibold">Gepubliceerd op:</span> {{ $assignment->created_at->format('d-m-Y H:i') }}
                        </p>
                        <p class="text-gray-700 mb-3 whitespace-pre-line">{{ $assignment->short_description }}</p>

                        @if($assignment->email || $assignment->phone_number)
                            <div class="mt-2 pt-2 border-t border-purple-200">
                                <h4 class="font-semibold text-gray-700 mb-1">Contact:</h4>
                                @if($assignment->email)
                                    <p class="text-gray-600">
                                        <i class="fa-solid fa-envelope mr-1 text-purple-600"></i>
                                        <a href="mailto:{{ $assignment->email }}" class="hover:underline">{{ $assignment->email }}</a>
                                    </p>
                                @endif
                                @if($assignment->phone_number)
                                    <p class="text-gray-600">
                                        <i class="fa-solid fa-phone mr-1 text-purple-600"></i>
                                        {{ $assignment->phone_number }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div id="pagination-container" class="mt-8 text-center">
                {{ $assignments->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <div class="text-center p-8 bg-gray-50 rounded-lg">
                <p class="text-gray-500 italic">Er zijn momenteel geen opdrachten beschikbaar.</p>
            </div>
        @endif

        {{-- Contact Informatie Concat --}}
        <div class="mt-12 bg-purple-50 p-6 rounded-lg shadow-inner" role="region" aria-labelledby="contact-concat-title">
            <h3 id="contact-concat-title" class="text-xl font-bold text-purple-700 mb-2">Opdracht Plaatsen?</h3>
            <p class="text-gray-700 mb-1">
                Wilt u als bedrijf een opdracht op deze pagina plaatsen? Neem dan contact op met het bestuur van SV Concat.
            </p>
            <p class="text-gray-700">
                <a href="mailto:info@svconcat.nl" class="text-purple-600 hover:underline" aria-label="Stuur een e-mail naar SV Concat">
                    <i class="fa-solid fa-envelope mr-1"></i> Stuur ons een e-mail
                </a>
                of neem contact op via een van onze andere kanalen.
            </p>
        </div>
    </div>
</x-layout>
