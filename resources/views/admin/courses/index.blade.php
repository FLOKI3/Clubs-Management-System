<x-admin-layout>
    @section('title', 'SESSIONS')
  <div class="flex justify-end mb-2">
    <a href="{{ route('admin.courses.exportPdf') }}" 
    type="button" class="text-gray-800 border border-gray-800 hover:bg-gray-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z"/>
    </svg>
    <span class="sr-only">Weekly calendar</span>
    </a>
    @can('Create sessions')
      <a href="{{ route('admin.courses.create') }}" type="button"
         class="ml-2 text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-800">
          Create Course
      </a>
    @endcan
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
  </script>
</x-admin-layout>
