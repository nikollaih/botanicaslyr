var c;

async function getHiddenDays(){
	var days = [0,1,2,3,4,5,6];
	postResult = await $.post("Config/getConfig/schedule_day", {}, ()=>{}, "json" );
	let response = eval(postResult);
	let value = response.obj.valor_configuracion;

	// Remove item 'seven' from array
	days = days.filter(function(e) { return e.toString() !== value });


	c = $('#fc-external-drag').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'agendaWeek,agendaDay'
		},
		hiddenDays: days,
		slotDuration: '00:30:00',
		defaultTimedEventDuration: '00:30:00',
		slotLabelInterval: '00:30:00',
		minTime: "07:00:00",
		maxTime: "19:00:00",
                defaultView: 'agendaDay'
		/*editable: true,
		droppable: false, // this allows things to be dropped onto the calendar
		
		drop: function() {
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
		}*/
	});
}
$(document).ready(function(){
	"use strict";
	
	/************************************************
	*				External Dragging				*
	************************************************/

	/* initialize the calendar
	-----------------------------------------------------------------*/

getHiddenDays();

	/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events .fc-event').each(function() {
		// store data so the calendar knows to render an event upon drop
		$(this).data('event', {
			title: $.trim($(this).text()), // use the element's text as the event title
			className: $(this).data('class'),
			stick: true // maintain when user navigates (see docs on the renderEvent method)
		});

		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});

	});
});