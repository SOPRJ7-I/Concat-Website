<x-layout>
    <div class="max-w-5xl mx-auto px-4 space-y-10 mt-10 mb-16">

        {{-- Mijn Account --}}
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h1 class="text-2xl font-bold text-purple-800 border-b-4 border-purple-500 inline-block pb-1">Mijn account
            </h1>

            @if(session('success'))
                <div class="text-green-700 bg-green-100 border border-green-300 p-4 rounded-lg mt-4 font-medium">
                    {{ session('success') }}
                </div>
            @endif



            <div class="mt-6 space-y-4 text-base">

                <div>
                    <span class="block font-semibold">Naam:</span>
                    <span class="text-purple-700">{{ $user->name }}</span>
                </div>

                <div>
                    <span class="block font-semibold">E-mailadres:</span>
                    <span class="text-purple-700">{{ $user->email }}</span>
                </div>

                <div>
                    <span class="block font-semibold">Wachtwoord:</span>
                    <span class="text-purple-700 tracking-widest">••••••••</span>
                    <p class="text-sm text-gray-500 italic mt-1">Je wachtwoord is versleuteld opgeslagen</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('account.edit') }}"
                    class="inline-block bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 transition font-semibold">
                    Bewerk gegevens
                </a>
            </div>
        </div>

        {{-- Gebruikersbeheer voor admins --}}
        @if($user->role === 'admin')
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-xl font-bold text-purple-800 border-b-4 border-purple-500 inline-block pb-1 mb-4">
                    Gebruikersbeheer</h2>

                @if(session('success'))
                    <div class="text-green-700 bg-green-100 border border-green-300 p-4 rounded-lg mb-4 font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="text-red-700 bg-red-100 border border-red-300 p-4 rounded-lg mb-4 font-medium">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-separate border-spacing-y-2">
                        <thead>
                            <tr class="bg-purple-200 text-left">
                                <th class="px-4 py-2 font-semibold">E-mailadres</th>
                                <th class="px-4 py-2 font-semibold">Huidige rol</th>
                                <th class="px-4 py-2 font-semibold">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $otherUser)
                                <tr class="bg-purple-50 hover:bg-purple-100 transition">
                                    <td class="px-4 py-2">{{ $otherUser->email }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($otherUser->role) }}</td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('account.updateUserRole', $otherUser) }}" method="POST"
                                            class="flex items-center space-x-2">
                                            @csrf
                                            <select name="role" class="border rounded px-3 py-1" required>
                                                <option value="student" @selected($otherUser->role === 'student')>Student</option>
                                                <option value="admin" @selected($otherUser->role === 'admin')>Beheerder</option>
                                            </select>
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-1.5 rounded hover:bg-red-600 transition">Opslaan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-layout>