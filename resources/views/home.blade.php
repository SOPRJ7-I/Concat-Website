<x-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Hoofd sectie -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Carrousel -->
            <div class="lg:col-span-2">
                <div class="swiper-container relative h-96 rounded-xl overflow-hidden shadow-lg">
                    <div class="swiper-wrapper">
                        @foreach($photos as $photo)
                            <div class="swiper-slide relative">
                                <img src="{{ $photo['src'] }}" alt="{{ $photo['title'] }}"
                                     class="w-full h-full object-cover">
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                                    <h3 class="text-xl font-bold text-white">{{ $photo['title'] }}</h3>
                                    <p class="text-gray-200 text-sm">{{ $photo['date'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Navigation buttons -->
                    <div class="swiper-button-next text-white"></div>
                    <div class="swiper-button-prev text-white"></div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <!-- Announcements -->
            <div class="bg-white p-6 rounded-xl shadow-lg h-fit lg:sticky lg:top-4">
                <h2 class="text-2xl font-bold border-b-4 border-yellow-500 inline-block pb-1 mb-4">
                    Aankondigingen
                </h2>

                <div class="space-y-4">
                    @if(count($groupedAnnouncements) > 0)
                        @include('announcements.partials.list', ['groupedAnnouncements' => $groupedAnnouncements])
                    @else
                        <div class="text-center p-8 bg-gray-50 rounded-lg">
                            <p class="text-gray-500 italic">Er zijn momenteel geen aankondigingen</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.swiper-container', {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            });
        </script>
    @endpush
</x-layout>
