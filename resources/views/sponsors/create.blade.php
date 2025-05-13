<x-layout>
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-5xl mt-5 mb-5">
        <h1 class="text-2xl font-bold border-b-4 border-purple-500 inline-block pb-1">
            Sponsor toevoegen
        </h1>
        <form method="POST" action="{{ route('sponsors.store') }}" enctype="multipart/form-data" class="mt-4 space-y-4" onsubmit="return validateForm()">
            @csrf
            <div>
                <x-form-label for="name">Naam*:</x-form-label>
                <x-form-input type="text" name="name" id="name" placeholder="Naam van de sponsor" required/>
                <x-form-error name="name"/>
            </div>

            <div>
                <x-form-label for="description">Beschrijving*:</x-form-label>
                <x-form-textarea name="description" id="description" placeholder="Beschrijving van de sponsor" rows="20"></x-form-textarea>
                <x-form-error name="description"/>
            </div>

            <div>
                <x-form-label for="url">URL:</x-form-label>
                <x-form-input type="url" name="url" id="url" placeholder="https://voorbeeld.com"/>
                <x-form-error name="url"/>
            </div>

            <div>
                <x-form-label for="logo">Logo*:</x-form-label>
                <x-form-input type="file" name="logo" id="logo" required/>
                <x-form-error name="logo"/>
            </div>

            <input type="submit" value="Toevoegen" class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition font-semibold cursor-pointer" alt="Klik om het evenement toe te voegen">
        </form>
    </div>
</x-layout>
