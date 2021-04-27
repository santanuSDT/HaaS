// Code goes here
$(document).ready(function() {

  // page is now ready, initialize the calendar...

  var calendar = $('#calendar').fullCalendar({
    // put your options and callbacks here
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'year,month,basicWeek,basicDay'

    },
    timezone: 'local',
    height: "auto",
    selectable: true,
    dragabble: true,
    defaultView: 'year',
    yearColumns: 3,
    year:2024,

    durationEditable: true,
    bootstrap: false,

  
  })
});