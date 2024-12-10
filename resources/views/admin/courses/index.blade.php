<x-admin-layout>
    @section('title', 'SESSIONS')
  <div class="flex justify-end mb-4">
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
                
                // Adjust title based on screen size
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
