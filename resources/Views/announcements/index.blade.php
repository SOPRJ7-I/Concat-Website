<x-layout>
    <div class="max-w-4xl mx-auto px-4 py-8 bg-white rounded-lg shadow-xl mt-5">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Aankondigingen</h1>

        <div id="announcements-container">
            @include('announcements.partials.list', ['groupedAnnouncements' => $groupedAnnouncements])
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('load-more')?.addEventListener('click', function() {
                const button = this;
                const nextPage = button.dataset.page;

                button.disabled = true;
                button.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-3 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Laden...
            `;

                fetch(`?page=${nextPage}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if(!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if(data.html) {
                            document.getElementById('announcements-container').insertAdjacentHTML('beforeend', data.html);
                        }

                        if(data.next_page) {
                            button.dataset.page = data.next_page;
                            button.disabled = false;
                            button.innerHTML = 'Meer laden';
                        } else {
                            button.remove();
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        button.innerHTML = 'Fout - probeer opnieuw';
                        button.disabled = false;
                    });
            });
        </script>
    @endpush
</x-layout>
