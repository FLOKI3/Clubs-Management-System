<x-admin-layout>
    @section('title', 'SESSIONS')
  <div class="flex justify-end mb-2">
    
    @can('Create sessions')
      <a href="{{ route('admin.courses.create') }}" type="button"
         class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-800">
          Create Course
      </a>
    @endcan
    <div class="relative inline-block text-left">
        <button 
            id="dropdownButton" 
            type="button" 
            class="ml-2 text-white bg-gray-800 border border-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center"
            aria-expanded="true" 
            aria-haspopup="true"
        >
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z"/>
            </svg>
            <span class="sr-only">Weekly calendar</span>
            <svg class="ml-2 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        <!-- Dropdown Menu -->
        <div 
            id="dropdownMenu" 
            class="absolute right-0 z-10 mt-2 w-44 bg-white border border-gray-300 rounded-lg shadow-md hidden"
            style="width: 150px;">   
            <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownButton">
                <li>
                    <a href="{{ route('admin.courses.exportPdf', ['week' => 'current']) }}" 
                       class="block px-4 py-2 hover:bg-gray-100">
                        This Week
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.courses.exportPdf', ['week' => 'second']) }}" 
                       class="block px-4 py-2 hover:bg-gray-100">
                        Second Week
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.courses.exportPdf', ['week' => 'third']) }}" 
                       class="block px-4 py-2 hover:bg-gray-100">
                        Third Week
                    </a>
                </li>
            </ul>
        </div>
    </div>
  </div>
  <div id="calendar"></div>
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              headerToolbar: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
              },
              buttonText: {
                  month: 'Month',
                  week: 'Week',
                  day: 'Day',
                  list: 'List'
              },
              events: [
                @foreach ($courses as $course)
                        @php
                            $lessonMedia = $course->lesson?->getFirstMedia('lessons_logo');
                            $lessonLogoUrl = $lessonMedia 
                                ? asset('storage/' . $lessonMedia->id . '/' . $lessonMedia->file_name) 
                                : asset('assets/images/no-image.png');
                        @endphp
                        {
                            id: '{{ $course->id }}',
                            title: '{{ optional($course->coach)->name ?? "Unknown Coach" }} ({{ optional($course->lesson)->name ?? "Unknown Lesson" }})',
                            start: '{{ $course->startTime }}',
                            end: '{{ $course->endTime }}',
                            color: '{{ '#' . substr(md5($course->club->id), 0, 6) }}',
                            description: 'Club: {{ $course->club->name }} | Room: {{ $course->room->name }} | Lesson: {{ $course->lesson->name }}',
                            logo: '{{ $lessonLogoUrl }}',
                        },
                    @endforeach
              ],
              eventClick: function (info) {
                  @can('Edit sessions')
                      window.location.href = "{{ url('dashboard/courses') }}/" + info.event.id + "/edit";
                  @else
                      alert(
                          'Event: ' + info.event.title + '\n' +
                          'Description: ' + info.event.extendedProps.description + '\n' +
                          'Start: ' + info.event.start.toLocaleString() + '\n' +
                          'End: ' + (info.event.end ? info.event.end.toLocaleString() : 'N/A')
                      );             
                  @endcan
              },
              eventContent: function(arg) {
                let logo = arg.event.extendedProps.logo
                    ? `<img src="${arg.event.extendedProps.logo}" style="width:20px; height:20px; margin-right:5px; border-radius:50%;" />`
                    : '';

                let title = window.innerWidth <= 768 
                    ? arg.event.title.slice(0, 15) + '...' 
                    : arg.event.title; 

                return { html: logo + `<span class="fc-event-title">${title}</span>` };
            },
            windowResize: function(view) {
                calendar.refetchEvents(); 
            }

          });

          calendar.render();
      });

      document.getElementById('dropdownButton').addEventListener('click', () => {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    });
  </script>

</x-admin-layout>
