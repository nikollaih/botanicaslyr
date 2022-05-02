var personsTable;
jQuery(document).ready(function(){
	personsTable = jQuery('#persons-list').DataTable({
		iDisplayLength: 25,
		"language": 
		{
		    "url": base_url + "assets/js/datatable-spanish.json"
		},
		order: [],
	}) 
})

jQuery(document).ready(function(){
	jQuery('#patient-appointment').DataTable({
		"language": 
		{
		    "url": base_url + "assets/js/datatable-spanish.json"
		},
		order: [],
		"paging": false
	}) 
}) 

jQuery(document).on('click', '#save-patient', function(){
	addPatient();
})

jQuery(document).on('click', '.btn-delete-person', function(){
    var idPerson = jQuery(this).attr('p-id');

    swal({
        title: '¿Esta seguro?',
        text: 'Desea eliminar el paciente',
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        cancelButtonColor: "#DD6B55",
        confirmButtonText: "Si, Continuar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false
    }, function(isConfirm){
        if(isConfirm) {
            personDelete(idPerson);
        }
    })
})


function addPatient(){
	if (formValidate('#personForm')){
		var data = formToArray('#personForm');
		post(data, "Persons/savePerson", responseAddPerson);
	}
}


function responseAddPerson(response){
    console.log(response)
	jQuery('.alert-form').hide();
	var data = eval(response);

	if (data['status'] === true) {
		restartForm('#personForm');
		jQuery('.alert-form strong').html('Exito!');
	}
	else{
		if (data['obj']['alert'] == 'warning') {
			jQuery('.alert-form strong').html('Aviso!');
		}
		else{
			jQuery('.alert-form strong').html('Error!');
		}
	}

	jQuery('.alert-form').removeClass('bg-info'); 
	jQuery('.alert-form').removeClass('bg-warning');
	jQuery('.alert-form').addClass('bg-' + data['obj']['alert']);
	jQuery('.alert-form span').html(data['msg']);
	jQuery('.alert-form').show();


	if(data['obj']['state'] == "add"){
		window.location.href = base_url + "appointments/appointmentAdd/" + data['obj']['id_persona']
	}
	else{
		window.location.href = base_url + "persons/updatePatient/" + data['obj']['id_persona']
	}
}


function personDelete(personId){
	post({id : personId}, "Persons/personDelete", responsePersonDelete);
}

function responsePersonDelete(response){
	var data = eval(response);

	if (data['status'] === true) {
		personsTable.row(jQuery('#' + data['obj']).parents('tr')).remove();
		personsTable.draw();
		swal("Exito!", data['msg'], "success");
	}
	else{
		swal("Error!", data['msg'], "error");
	}
}

function searchPatients(personId, call, action = ''){
	post({id : personId}, "Persons/personSearch/true", call, action);
}


function loadPatientsList(response, action){
	var data = eval(response);
	var persons = data['obj'];

	if(data['status'] == false){
		loadPatient('no-find', loadAppointmentPatient, 'appointment_search');
	}
	else{
		if (persons.length == 1) {
			loadPatient(persons[0]['numero_documento'], loadAppointmentPatient, 'appointment_search');
		} else {
			var tbody_DOM = "";
			for (let i = 0; i < persons.length; i++) {
				const p = persons[i];
				tbody_DOM  	+= "<tr>"
							+ 	"<td>"+p['numero_documento']+"</td>"
							+ 	"<td>"+p['nombre_persona']+ ' ' + p['apellidos_persona'] + "</td>"
							+  	"<td><a person-id='"+p['numero_documento']+"' class='btn-asign-app btn btn-xs btn-primary btn-icon' id=''><i class='fa fa-plus'></i> Asignar</a></td>"
							+ "</tr>";
			}

			$('#tabla-pacientes tbody').html(tbody_DOM);
			$('#appointment-persons').modal();
		}
	}
}

function loadPatient(personId, call, action = ''){
	post({id : personId}, "Persons/personSearch", call, action);
}

function loadAppointmentPatient(response, action = ''){
	var data = eval(response);

	if (action == 'appointment_search') {
		if (data['status'] === false) {
			jQuery('#p-person').val(0);
			jQuery('.response-patient').removeClass('bg-info');
			jQuery('.response-patient').addClass('bg-danger');
			jQuery('.response-patient').find('strong').html('Error!');
			jQuery('.response-patient').find('span').html(data['msg']);
			jQuery('.response-patient').show();
			jQuery('.table.hide').hide();
		}
		else{
			var p = data['obj'];
			jQuery('.alert-form').hide();
			jQuery('#p-person').val(p['id_persona']);
			jQuery('#p-name').html(p['nombre_persona']);
			jQuery('#p-last-name').html(p['apellidos_persona']);
			jQuery('#p-phone').html(p['telefono_persona']);
			jQuery('#p-email').html(p['correo_persona']);
			jQuery('#p-address').html(p['direccion_persona']);
			jQuery('.response-patient').removeClass('bg-danger');
			jQuery('.response-patient').addClass('bg-info');
			jQuery('.response-patient').find('strong').html('Nota!');
			jQuery('.response-patient').find('span').html('La información del paciente será cargada al buscarlo por el número de documento');
			jQuery('.response-patient').hide();
			jQuery('.table.hide').show();
		}
	}
}