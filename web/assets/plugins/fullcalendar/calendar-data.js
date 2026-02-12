
if ($('#calendar').length > 0) {
  document.addEventListener('DOMContentLoaded', function() {
    // ✅ External events draggable
    var containerEl = document.getElementById('external-events');
    new FullCalendar.Draggable(containerEl, {
      itemSelector: '.fc-event',
      eventData: function(eventEl) {
        var className = eventEl.getAttribute('data-event-classname');
        return {
          title: eventEl.innerText.trim(),
          classNames: [className],
        };
      }
    });

    // ✅ Calendar
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'today prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      initialView: 'dayGridMonth',
      editable: true,
      droppable: true, // ✅ allow external event drop
      eventDisplay: 'block',
      views: {
        dayGridMonth: {
          eventDisplay: 'block',
          dayMaxEvents: true
        }
      },
      eventDidMount: function(info) {
        // ✅ Show only title in month view
        if (info.view.type === 'dayGridMonth') {
          var eventEl = info.el;
          var timeElements = eventEl.querySelectorAll('.fc-event-time');
          timeElements.forEach(function(el) {
            el.style.display = 'none';
          });
          var titleEl = eventEl.querySelector('.fc-event-title');
          if (titleEl) {
            titleEl.style.fontWeight = 'normal';
          }
        }
      },
      events: [
        {
          title: 'Meeting',
          className: 'badge badge-info',
          backgroundColor: '#0080ff',
          textColor: "#fff",
          start: new Date($.now() - 168000000).toISOString(),
          allDay: true
        },
        {
          title: 'Office',
          className: 'badge badge-secondary',
          backgroundColor: '#6d777f',
          textColor: "#fff",
          start: new Date($.now() + 338000000).toISOString(),
          allDay: true
        },
        {
          title: 'Hiring',
          className: 'badge badge-success',
          backgroundColor: '#01b664',
          textColor: "#fff",
          start: new Date($.now() - 338000000).toISOString(),
          allDay: true
        },
        {
          title: 'Holiday',
          className: 'badge badge-pink',
          backgroundColor: '#f301ca',
          textColor: "#fff",
          start: new Date($.now() + 68000000).toISOString(),
          allDay: true
        },
        {
          title: 'Employee',
          className: 'badge badge-warning',
          backgroundColor: '#f9b801',
          textColor: "#fff",
          start: new Date($.now() + 88000000).toISOString(),
          allDay: true
        }
      ],
      eventClick: function(info) {
        // ✅ Show event details in modal
        $('#event_modal').modal('show');
        document.getElementById('eventTitle').innerText = info.event.title;
      },
      dateClick: function(info) {
        // ✅ Show add modal only if clicked empty date
        if (info.dayEl && !info.dayEl.querySelector('.fc-event')) {
          $('#add_new').modal('show');
        }
      },
      drop: function(info) {
        console.log('External event dropped');
      },
      eventReceive: function(info) {
        console.log('Event added', info.event.title);
      }
    });

    calendar.render();
  });
}



if($('#calendar1').length > 0) {

    document.addEventListener('DOMContentLoaded', function() {
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },

            height: 500,
            contentHeight: 580,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio


            views: {
                dayGridMonth: { buttonText: 'month' },
                timeGridWeek: { buttonText: 'week' },
                timeGridDay: { buttonText: 'day' }
            },

            initialView: 'dayGridMonth',
            initialDate: TODAY,

            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            navLinks: true,
            events: [
                {
                    title: 'All Day Event',
                    start: new Date($.now() - 168000000).toISOString(),
                    backgroundColor: '#FDE9ED',
                    allDay: true
                },
                {
                    id: 1000,
                    title: 'Repeating Event',
                    start: new Date($.now() - 338000000).toISOString(),
                    allDay: true
                }
            ]
        });

        calendar.render();
    });
}