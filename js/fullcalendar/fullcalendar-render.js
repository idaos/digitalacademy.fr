jQuery( document ).ready(function() {

    // init calendar
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        firstDay: 1,
        editable: false,
        events: []
    });
    // set event source and render 
    if (typeof eventsJson !== 'undefined') {
        calendar.addEventSource(eventsJson);
        calendar.refetchEvents();
    }
    calendar.render();

    // rerender calendar on thematique selection
    if ( jQuery('[id^=thematique-checkbox-]').length ) {
        jQuery('[id^=thematique-checkbox-]').on('change',function(){

            var thClr = jQuery(this).val();
            var filteredEvents = eventsJson.filter(item=>item.color==thClr);

            calendar.removeAllEvents();
            calendar.addEventSource(filteredEvents);
            calendar.refetchEvents();
        });
    };

})