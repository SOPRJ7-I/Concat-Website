<x-layout>
    <div class="container max-w-4xl mx-auto px-4 py-8 bg-white rounded-lg shadow-xl mt-5"> <!-- max-w-4xl vervangen door container -->
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Announcements</h1>

        <div id="announcements-container">
            @include('announcements.partials.list', ['groupedAnnouncements' => $groupedAnnouncements])
        </div>
    </div>
</x-layout>
