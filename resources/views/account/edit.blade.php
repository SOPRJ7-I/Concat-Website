<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-3xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1">Gegevens bewerken</h1>

        <form method="POST" action="{{ route('account.update') }}" class="mt-4 space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-l font-bold">E-mailadres*</label>
                <input type="email" name="email" id="email"
                       value="{{ old('email', $user->email) }}"
                       class="w-full p-2 {{ $errors->has('email') ? 'bg-red-100 border-red-300 text-red-700' : 'bg-purple-100 border-purple-300 text-purple-700' }} rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                @error('email')
                <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                @enderror
            </div>

            <div class="border-t pt-4">
                <h2 class="text-lg font-bold">Wachtwoord wijzigen (optioneel)</h2>

                <div>
                    <label for="current_password" class="block text-l font-bold">Huidig wachtwoord*</label>
                    <input type="password" name="current_password" id="current_password"
                           class="w-full p-2 {{ $errors->has('current_password') ? 'bg-red-100 border-red-300 text-red-700' : 'bg-purple-100 border-purple-300 text-purple-700' }} rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                    @error('current_password')
                    <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-l font-bold">Nieuw wachtwoord</label>
                    <input type="password" name="password" id="password"
                           class="w-full p-2 {{ $errors->has('password') ? 'bg-red-100 border-red-300 text-red-700' : 'bg-purple-100 border-purple-300 text-purple-700' }} rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                    @error('password')
                    <div class="text-red-500 text-l mt-1 font-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-l font-bold">Bevestig nieuw wachtwoord</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full p-2 bg-purple-100 border-purple-300 text-purple-700 rounded-lg outline-none border focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            <input type="submit" value="Opslaan"
                   class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer">
        </form>
    </div>
</x-layout>
