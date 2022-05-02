var colors = ['#36a3f7', '#F6BB42', '#33d8c9', '#2980b9', '#e24e4e'];

jQuery(document).ready(function()
{
    allSchedules();
    
    jQuery(document).on('change', "#day-select", function()
{
        setScheduleDay($(this).val())
      });
})

jQuery(document).on('click', '#BtnNewSchedule', function()
{
    if (formValidate('#form-schedule')) {
        var data = formToArray('#form-schedule');
        post(data, 'Schedules/saveSchedule', addScheduleresponse);
    }
})


jQuery(document).on('click', '.btn-new-schedule', function()
{
    jQuery('.hidde-update').show();
    jQuery('#s-paciente-agenda').val('');
    jQuery('#s-observaciones-agenda').val('');
    jQuery('#s-estado-agenda').val(1);
    jQuery('#s-id-agenda').val('null');
    jQuery('#s-fecha-agenda').addClass('required');
    jQuery('#s-hora-agenda').addClass('required');
})

jQuery(document).on('click', '.event-schedule', function(){
    var classes = $(this).attr('class');
    var userClass = classes.match(/s\-\d+/gi)[0];

    var idSchedule = userClass.split('-')[1];

    post(0, 'Schedules/get/' + idSchedule, responseUpdateSchedule);
})


function responseUpdateSchedule(response){
    var data = eval(response);
    var s = data['obj'];
    jQuery('.hidde-update').hide();
    jQuery('#s-paciente-agenda').val(s['paciente_agenda']);
    jQuery('#s-observaciones-agenda').val(s['observaciones_agenda']);
    jQuery('#s-estado-agenda').val(s['estado_agenda']);
    jQuery('#s-id-agenda').val(s['id_agenda']);
    jQuery('#s-fecha-agenda').removeClass('required');
    jQuery('#s-hora-agenda').removeClass('required');
    $('#scheduleModal').modal('toggle');
}

function addScheduleresponse(response)
{
    var data = eval(response);
    console.log(response);
    s = data['obj'];
    if (data['status'] != false) {
        if(data['status'] == 'added')
        {
            addEventCalendar(s['fecha_hora_agenda'], s['paciente_agenda'], s['id_agenda'], colors[parseInt(s['estado_agenda']) - 1]);
            notification('Exito!', 'Agenda realizada exitosamente', 'success');
        }
        else
        {
            jQuery('.s-' + s['id_agenda']).css('background-color', colors[parseInt(s['estado_agenda']) - 1]);
            jQuery('.s-' + s['id_agenda']).css('border-color', colors[parseInt(s['estado_agenda']) - 1]);
            jQuery('.s-' + s['id_agenda'] + ' .fc-title').html(s['paciente_agenda']);
            notification('Exito!', 'Agenda modificada exitosamente', 'success');
        }
        
        $('#scheduleModal').modal('toggle');
    }
    else{
        notification('Error!', 'Ha ocurrido un error', 'error');
    }
}

function addEventCalendar(date, tittle, id, color)
{
	$(c).fullCalendar('renderEvent', {
		id: id,
		title: tittle,
        start: date,
        color: color,
        className: 'event-schedule s-' + id,
        stick: true
	  }, true);
}

function allSchedules()
{
    post(0, 'Schedules/all', allSchedulesResponse);
}

function allSchedulesResponse(response)
{
    var data = eval(response);
    var s = data['obj'];

    if (s != false) {
        for (let i = 0; i < s.length; i++) {
            const e = s[i];
            
            addEventCalendar(e['fecha_hora_agenda'], e['paciente_agenda']+' - ' + e['observaciones_agenda'], e['id_agenda'], colors[parseInt(e['estado_agenda']) - 1]);
        }
    }
}

function setScheduleDay(value){
    post({}, 'Config/setConfig/schedule_day/' + value, responseDay);
}

function responseDay(response){
    location.reload();
}