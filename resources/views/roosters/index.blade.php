<x-layout>
    <div class="max-w-7xl mx-auto p-6 flex gap-6">

        {{-- Left side: Calendar --}}
        <div class="w-1/4 p-4 border rounded shadow-sm" style="min-width: 250px;">
            <h2 class="text-xl font-semibold mb-3">Kalender</h2>
            <div id="inlineCalendar" class="select-none"></div>
        </div>

        {{-- Middle: Events --}}
        <div class="flex-1 p-4 border rounded shadow-sm">
            <h2 class="text-xl font-semibold mb-3">Evenementen</h2>
            <ul id="eventsList" class="space-y-3 max-h-[600px] overflow-y-auto">
                @foreach($events as $event)
                    <li class="p-3 border rounded shadow-sm event-item"
                        data-calendar="{{ $event['calendar_name'] }}"
                        data-start="{{ \Carbon\Carbon::createFromFormat('d-m-Y H:i', $event['start'])->format('Y-m-d') }}"
                        style="border-left: 5px solid {{ $event['color'] }};">
                        <strong>{{ $event['title'] }}</strong><br>
                        Start: {{ $event['start'] }}<br>
                        Eind: {{ $event['end'] }}
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Right side: Rooster toevoegen + calendar toggles --}}
        <div class="w-1/4 p-4 border rounded shadow-sm space-y-6">
            {{-- Rooster toevoegen --}}
            <div>
                <h1 class="text-2xl font-bold mb-4">Rooster toevoegen</h1>
                <form action="/roosters" method="POST" class="mb-4">
                    @csrf
                    <input type="url" name="ical_url" placeholder="https://rooster.avans.nl/gcal/..." required
                           class="w-full p-2 border rounded mb-2">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded w-full">Toevoegen</button>
                </form>

                @if(session('success'))
                    <p class="text-green-600 mb-4">{{ session('success') }}</p>
                @endif
            </div>

            {{-- Kalender selecties --}}
            <div>
                <h2 class="text-xl font-semibold mb-3">Kalenders selecteren</h2>

                @if($roosters->count() > 0)
                    @foreach($roosters as $index => $rooster)
                        @php
                            $shortName = substr($rooster->ical_url, -10);
                            $color = $colors[$index % count($colors)];
                        @endphp
                        <div class="flex items-center justify-between mb-2 border rounded p-2">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="selected_calendars[]" value="{{ $shortName }}" checked
                                       class="toggle-calendar" data-color="{{ $color }}">
                                <span class="ml-2" style="color: {{ $color }};">{{ $shortName }}</span>
                            </label>

                            <form action="{{ route('roosters.destroy', $rooster->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze kalender wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 px-2" title="Verwijder rooster">
                                    &times;
                                </button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p>Geen kalenders toegevoegd.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const calendarCheckboxes = document.querySelectorAll('.toggle-calendar');
            const eventItems = document.querySelectorAll('.event-item');

            let selectedDate = null;

            const eventDatesSet = new Set();
            eventItems.forEach(ev => {
                eventDatesSet.add(ev.getAttribute('data-start'));
            });
            const eventDates = Array.from(eventDatesSet);

            const calendarEl = document.getElementById('inlineCalendar');

            function createCalendar(year, month) {
                calendarEl.innerHTML = '';

                const monthNames = ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];
                const daysOfWeek = ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'];

                const header = document.createElement('div');
                header.classList.add('flex', 'justify-between', 'items-center', 'mb-2');
                header.style.userSelect = 'none';

                const prevBtn = document.createElement('button');
                prevBtn.textContent = '<';
                prevBtn.classList.add('px-2', 'py-1', 'bg-gray-200', 'rounded');
                prevBtn.onclick = () => {
                    const prevMonth = month === 0 ? 11 : month - 1;
                    const prevYear = month === 0 ? year - 1 : year;
                    createCalendar(prevYear, prevMonth);
                };

                const nextBtn = document.createElement('button');
                nextBtn.textContent = '>';
                nextBtn.classList.add('px-2', 'py-1', 'bg-gray-200', 'rounded');
                nextBtn.onclick = () => {
                    const nextMonth = month === 11 ? 0 : month + 1;
                    const nextYear = month === 11 ? year + 1 : year;
                    createCalendar(nextYear, nextMonth);
                };

                const title = document.createElement('div');
                title.textContent = `${monthNames[month]} ${year}`;
                title.classList.add('font-semibold');

                header.appendChild(prevBtn);
                header.appendChild(title);
                header.appendChild(nextBtn);
                calendarEl.appendChild(header);

                const daysRow = document.createElement('div');
                daysRow.classList.add('grid', 'grid-cols-7', 'text-center', 'text-sm', 'font-semibold', 'mb-1');
                daysOfWeek.forEach(d => {
                    const dEl = document.createElement('div');
                    dEl.textContent = d;
                    daysRow.appendChild(dEl);
                });
                calendarEl.appendChild(daysRow);

                const datesGrid = document.createElement('div');
                datesGrid.classList.add('grid', 'grid-cols-7', 'gap-1', 'text-center', 'text-sm');

                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                for (let i = 0; i < firstDay; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.innerHTML = '&nbsp;';
                    datesGrid.appendChild(emptyCell);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const dateStr = `${year}-${String(month + 1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
                    const dateCell = document.createElement('div');
                    dateCell.textContent = day;
                    dateCell.classList.add('cursor-pointer', 'rounded', 'p-1');

                    if (eventDates.includes(dateStr)) {
                        dateCell.classList.add('bg-green-200', 'font-bold');
                    }

                    if (selectedDate === dateStr) {
                        dateCell.classList.add('bg-green-500', 'text-white');
                    }

                    dateCell.onclick = () => {
                        if (selectedDate === dateStr) {
                            selectedDate = null;
                        } else {
                            selectedDate = dateStr;
                        }
                        updateEventsVisibility();
                        createCalendar(year, month);
                    };

                    datesGrid.appendChild(dateCell);
                }

                calendarEl.appendChild(datesGrid);
            }

            function updateEventsVisibility() {
                const checkedCalendars = Array.from(calendarCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                eventItems.forEach(eventEl => {
                    const calName = eventEl.getAttribute('data-calendar');
                    const eventDate = eventEl.getAttribute('data-start');

                    const showByCalendar = checkedCalendars.includes(calName);
                    const showByDate = !selectedDate || (eventDate === selectedDate);

                    eventEl.style.display = (showByCalendar && showByDate) ? 'block' : 'none';
                });
            }

            calendarCheckboxes.forEach(cb => {
                cb.addEventListener('change', () => {
                    updateEventsVisibility();
                });
            });

            const now = new Date();
            createCalendar(now.getFullYear(), now.getMonth());
            updateEventsVisibility();
        });
    </script>

    <style>
        #inlineCalendar > div.grid > div {
            user-select: none;
            transition: background-color 0.3s;
        }
        #inlineCalendar > div.grid > div:hover {
            background-color: #a7f3d0;
        }
    </style>
</x-layout>
