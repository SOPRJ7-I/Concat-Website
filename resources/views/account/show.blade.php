<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-3xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1">Mijn account</h1>

        @if(session('success'))
            <div class="text-green-700 bg-green-100 border border-green-300 p-3 rounded-lg mt-4 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-4 space-y-4">
            <div>
                <span class="block text-l font-bold">E-mailadres:</span>
                <span class="block text-purple-700">{{ Auth::user()->email }}</span>
            </div>

            <div>
                <span class="block text-l font-bold">Wachtwoord:</span>
                <div class="flex items-center space-x-2 text-purple-700">
                    <span class="tracking-widest">••••••••</span>
                    <span title="Je wachtwoord is versleuteld en veilig opgeslagen" class="text-sm text-gray-500 italic"></span>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('account.edit') }}"
               class="inline-block bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition font-semibold">
                Bewerk gegevens
            </a>
        </div>
    </div>
</x-layout>
