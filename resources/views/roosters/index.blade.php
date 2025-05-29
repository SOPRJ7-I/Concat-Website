<x-layout>
    @php
        $klasColors = [
            1 => '#e6194b',
            2 => '#3cb44b',
            3 => '#ffe119',
            4 => '#4363d8',
        ];
    @endphp

<div class="bg-white min-h-screen py-6 px-4 sm:px-6 lg:px-8 rounded-2xl">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-6">

            {{-- Left: Calendar --}}
            <div class="w-full lg:w-1/4 p-4 border rounded shadow-sm">
                <h2 class="text-xl font-semibold mb-3">Kalender</h2>
                <div id="inlineCalendar" class="select-none"></div>
            </div>

            {{-- Middle: Chart --}}
            <div class="w-full lg:flex-1 p-4 border rounded shadow-sm">
                <h2 class="text-xl font-semibold mb-3">Uurlijkse drukte (08:00 - 22:00)</h2>
                <canvas id="hourlyChart" height="150"></canvas>
                <div class="block sm:hidden text-gray-500 mt-2 text-sm italic">
                    * Roosternamen zijn verborgen op mobiel
                </div>
            </div>

            {{-- Right: Rooster form and toggles --}}
            <div class="w-full lg:w-1/4 p-4 border rounded shadow-sm space-y-6">
                <div>
                    <h1 class="text-2xl font-bold mb-4">Rooster toevoegen</h1>
                    <form action="/roosters" method="POST" class="mb-4">
                        @csrf
                        <input type="url" name="ical_url" placeholder="https://rooster.avans.nl/gcal/..." required
                            class="w-full p-2 border rounded mb-2">
                        <select name="klas" required class="w-full p-2 border rounded mb-2">
                            <option value="">Selecteer een klas</option>
                            <option value="1">Klas 1</option>
                            <option value="2">Klas 2</option>
                            <option value="3">Klas 3</option>
                            <option value="4">Klas 4</option>
                        </select>

                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded w-full">Toevoegen</button>
                    </form>

                    @if(session('success'))
                        <p class="text-green-600 mb-4">{{ session('success') }}</p>
                    @endif
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-3">Kalenders selecteren</h2>
                    @if($roosters->count() > 0)
                        @foreach($roosters as $rooster)
                            @php
                                $shortName = substr($rooster->ical_url, -10);
                                $color = $klasColors[$rooster->klas] ?? '#999999';
                            @endphp
                            <div class="flex items-center justify-between mb-2 border rounded p-2">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="selected_calendars[]" value="{{ $shortName }}" checked
                                        class="toggle-calendar" data-color="{{ $color }}">
                                    <span class="ml-2" style="color: {{ $color }};">{{ $shortName }}</span>
                                </label>

                                <form action="{{ route('roosters.destroy', $rooster->id) }}" method="POST"
                                    onsubmit="return confirm('Weet je zeker dat je deze kalender wilt verwijderen?');">
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
    </div>

    {{-- Hidden lessons list --}}
    <ul id="lessonsList" class="hidden">
        @foreach($events as $event)
            @php
                $eventColor = '#999999'; 
                foreach($roosters as $r) {
                    $shortName = substr($r->ical_url, -10);
                    if($shortName === $event['calendar_name']) {
                        $eventColor = $klasColors[$r->klas] ?? '#999999';
                        break;
                    }
                }
            @endphp
            <li class="lesson-item"
                data-calendar="{{ $event['calendar_name'] }}"
                data-start="{{ \Carbon\Carbon::createFromFormat('d-m-Y H:i', $event['start'])->format('Y-m-d') }}"
                data-start-time="{{ \Carbon\Carbon::createFromFormat('d-m-Y H:i', $event['start'])->format('H:i') }}"
                style="border-left: 5px solid {{ $eventColor }};">
                <strong>{{ $event['title'] }}</strong><br>
                Start: {{ $event['start'] }}<br>
                Eind: {{ $event['end'] }}
            </li>
        @endforeach
    </ul>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const startHour = 8;
        const endHour = 22;
        const hourLabels = [];
        for (let h = startHour; h <= endHour; h++) {
            hourLabels.push(`${h.toString().padStart(2, '0')}:00`);
        }

        const ctx = document.getElementById('hourlyChart').getContext('2d');
        const hourlyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: hourLabels,
                datasets: []
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                if (Number.isInteger(value)) return value;
                            },
                            stepSize: 1,
                            min: 0
                        },
                        title: { display: true, text: 'Aantal lessen' }
                    },
                    x: {
                        stacked: true,
                        title: { display: true, text: 'Uur van de dag' }
                    }
                },
                plugins: {
                    tooltip: { mode: 'index', intersect: false },
                    legend: {
                        position: 'bottom',
                        labels: {
                            filter: function (item, chart) {
                                return window.innerWidth >= 640; // Only show legend on sm+ screens
                            }
                        }
                    }
                }
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const calendarCheckboxes = document.querySelectorAll('.toggle-calendar');
            const lessonItems = document.querySelectorAll('.lesson-item');
            let selectedDate = null;
            const lessonDatesSet = new Set();
            lessonItems.forEach(ev => lessonDatesSet.add(ev.getAttribute('data-start')));
            const lessonDates = Array.from(lessonDatesSet);
            const calendarEl = document.getElementById('inlineCalendar');

            function createCalendar(year, month) {
                calendarEl.innerHTML = '';
                const monthNames = ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];
                const daysOfWeek = ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'];

                const header = document.createElement('div');
                header.classList.add('flex', 'justify-between', 'items-center', 'mb-2');

                const prevBtn = document.createElement('button');
                prevBtn.textContent = '<';
                prevBtn.classList.add('px-2', 'py-1', 'bg-gray-200', 'rounded');
                prevBtn.onclick = () => createCalendar(month === 0 ? year - 1 : year, (month + 11) % 12);

                const nextBtn = document.createElement('button');
                nextBtn.textContent = '>';
                nextBtn.classList.add('px-2', 'py-1', 'bg-gray-200', 'rounded');
                nextBtn.onclick = () => createCalendar(month === 11 ? year + 1 : year, (month + 1) % 12);

                const title = document.createElement('div');
                title.textContent = `${monthNames[month]} ${year}`;
                title.classList.add('font-semibold');

                header.appendChild(prevBtn);
                header.appendChild(title);
                header.appendChild(nextBtn);
                calendarEl.appendChild(header);

                const daysHeader = document.createElement('div');
                daysHeader.classList.add('grid', 'grid-cols-7', 'gap-1', 'text-center', 'mb-1');
                daysOfWeek.forEach(day => {
                    const d = document.createElement('div');
                    d.textContent = day;
                    d.classList.add('font-medium');
                    daysHeader.appendChild(d);
                });
                calendarEl.appendChild(daysHeader);

                const firstDayOfMonth = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                const grid = document.createElement('div');
                grid.classList.add('grid', 'grid-cols-7', 'gap-1');

                for(let i = 0; i < firstDayOfMonth; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.classList.add('p-2');
                    grid.appendChild(emptyCell);
                }

                for(let day = 1; day <= daysInMonth; day++) {
                    const dateStr = `${year}-${(month+1).toString().padStart(2,'0')}-${day.toString().padStart(2,'0')}`;
                    const cell = document.createElement('button');
                    cell.textContent = day;
                    cell.classList.add('p-2', 'rounded', 'hover:bg-gray-200');
                    cell.type = 'button';

                    if (lessonDates.includes(dateStr)) {
                        cell.classList.add('font-bold', 'cursor-pointer');
                    } else {
                        cell.classList.add('text-gray-400', 'cursor-default');
                        cell.disabled = true;
                    }

                    if (selectedDate === dateStr) {
                        cell.classList.add('bg-blue-400', 'text-white');
                    }

                    cell.onclick = () => {
                        selectedDate = dateStr;
                        updateChart();
                        createCalendar(year, month);
                    };

                    grid.appendChild(cell);
                }

                calendarEl.appendChild(grid);
            }

            function updateChart() {
                if (!selectedDate) {
                    hourlyChart.data.datasets = [];
                    hourlyChart.update();
                    return;
                }

                const selectedCalendars = Array.from(calendarCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => ({name: cb.value, color: cb.dataset.color}));

                if(selectedCalendars.length === 0) {
                    hourlyChart.data.datasets = [];
                    hourlyChart.update();
                    return;
                }

                const datasets = selectedCalendars.map(c => ({
                    label: c.name,
                    backgroundColor: c.color,
                    data: Array(endHour - startHour + 1).fill(0),
                    stack: 'Stack 0'
                }));

                lessonItems.forEach(lesson => {
                    const calName = lesson.getAttribute('data-calendar');
                    const lessonDate = lesson.getAttribute('data-start');
                    const startTime = lesson.getAttribute('data-start-time');

                    if (!selectedCalendars.some(c => c.name === calName)) return;
                    if (lessonDate !== selectedDate) return;

                    const [h] = startTime.split(':').map(Number);
                    if (h < startHour || h > endHour) return;

                    const dsIndex = selectedCalendars.findIndex(c => c.name === calName);
                    if (dsIndex < 0) return;

                    datasets[dsIndex].data[h - startHour]++;
                });

                hourlyChart.data.datasets = datasets;
                hourlyChart.update();
            }

            calendarCheckboxes.forEach(cb => {
                cb.addEventListener('change', () => updateChart());
            });

            const today = new Date();
            createCalendar(today.getFullYear(), today.getMonth());
            updateChart();
        });
    </script>
</x-layout>
