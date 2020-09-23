var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    header: {
        right: 'today prev,next',
        center: '',
        left: 'title'
    },
    locale: 'fr',
    defaultDate: '2020-09-22',
    firstDay: 1,
    editable: false,
    eventLimit: true,
    events: []
});
calendar.render();