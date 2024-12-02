<x-admin-layout>
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
                      {
                          id: '{{ $course->id }}',
                          title: '{{ $course->club->name }} ({{ $course->coach->name }})',
                          start: '{{ $course->startTime }}',
                          end: '{{ $course->endTime }}',
                          color: '{{ '#' . substr(md5($course->club->id), 0, 6) }}',
                          description: 'Club: {{ $course->club->name }} | Room: {{ $course->room->name }} | Lesson: {{ $course->lesson->name }}',
                      },
                  @endforeach
              ],
              eventClick: function (info) {
                  @can('Edit sessions')
                      // Redirect to the edit page for the selected course
                      window.location.href = "{{ url('dashboard/courses') }}/" + info.event.id + "/edit";
                  @else
                      // Show event information in an alert
                      alert(
                          'Event: ' + info.event.title + '\n' +
                          'Description: ' + info.event.extendedProps.description + '\n' +
                          'Start: ' + info.event.start.toLocaleString() + '\n' +
                          'End: ' + (info.event.end ? info.event.end.toLocaleString() : 'N/A')
                      );
                  @endcan
              }
          });

          calendar.render();
      });
  </script>
</x-admin-layout>
