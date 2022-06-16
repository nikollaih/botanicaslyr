jQuery(document).ready(function() {
    appointmentsTable = jQuery('#appointments-list').DataTable({
        iDisplayLength: 25,
        "language": {
            "url": base_url + "assets/js/datatable-spanish.json"
        },
        order: [],
    })

    jQuery('.summernote').summernote({
        height: '200px',
        toolbar: [
            ['headline', ['style']],
            ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
            ['textsize', ['fontsize']],
            ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']]
        ],
    });

    jQuery('.summernote.hc').summernote('fontSize', 24);
    jQuery('.summernote.rc').summernote('fontSize', 24);
    jQuery('.summernote.he').summernote('fontSize', 24);

    /*$('.note-editable').css('font-size', '24px');*/
    $('.note-editable').css('font-weight', 'bold');
    /*$('.note-editable').css('text-align', 'justify');*/
})

jQuery(document).on('click', '.btn-asign-app', function() {
    var personId = jQuery(this).attr('person-id');
    loadPatient(personId, loadAppointmentPatient, 'appointment_search');
    $('#appointment-persons').modal('toggle');
})

jQuery(document).on('click', '.btn-sp', function() {
    var idP = jQuery(this).parents('td').attr('data-p');
    var dType = jQuery(this).parents('td').attr('data-type');

    post({
            d: {
                id_producto: idP,
                id_consulta: id_consulta, //! id_consulta is declared on views/pages/appointments/show
                precio_producto_pc: jQuery('#sp-' + idP).find('.sp-price').val(),
                cantidad_producto_pc: jQuery('#sp-' + idP).find('.sp-count').val(),
                id_producto_consulta: 'null'
            },
            type: dType
        },
        "Appointments/appointmentProduct",
        responseAppointmentProduct
    );
})


jQuery(document).on('click', '.btn-sp-delete', function() {
    var idP = jQuery(this).parents('td').attr('data-p');
    var dType = jQuery(this).parents('td').attr('data-type');
    var idPA = jQuery(this).parents('td').attr('data-id');

    post({
            d: {
                id_producto: idP,
                id_consulta: id_consulta, //! id_consulta is declared on views/pages/appointments/show
                precio_producto_pc: jQuery('#spa-' + idPA).find('.sp-price').val(),
                cantidad_producto_pc: jQuery('#spa-' + idPA).find('.sp-count').val(),
                id_producto_consulta: idPA
            },
            type: dType
        },
        "Appointments/appointmentProduct",
        responseAppointmentProduct
    );
})

jQuery(document).on('click', '#save-appointment', function() {
    addAppointment();
})

jQuery(document).on('click', '#search-patient', function() {
    var id = jQuery('#pat-id').val();
    if (id.length > 0) {
        searchPatients(id, loadPatientsList, 'appointment_search');
    }
})

jQuery(document).on('click', '.btn-delete-appointment', function() {
    var aId = jQuery(this).attr('a-id');
    swal({
        title: 'Esta seguro?',
        text: 'Desea eliminar la consulta',
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        cancelButtonColor: "#DD6B55",
        confirmButtonText: "Si, Continuar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false
    }, function(isConfirm) {
        if (isConfirm) {
            appointmentDelete(aId);
        }
    })
})

function addAppointment() {
    if (formValidate('#appointmentForm')) {
        var data = formToArray('#appointmentForm');
        if (data['id_persona'] == 0 || data['id_persona'] == 'null') {
            alertForm('bg-danger', 'Error!', 'Por favor seleccione un paciente');
        } else {
            post(data, "Appointments/appointmentSave", responseAddAppointment);
        }
    }
}

function responseAddAppointment(response) {
    jQuery('.alert-form').hide();
    var data = eval(response);
    var className = 'bg-' + data['obj']['alert'];
    if (data['status'] === true) {
        if (data['obj']['action'] == 'create') {
            restartForm('#appointmentForm');
            jQuery('.response-patient').show();
            jQuery('.table').hide();
            jQuery('#pat-id').val('');
        }

        alertForm(className, 'Exito!', data['msg']);

        window.location.href = base_url + 'Appointments/show/' + data['obj']['id_consulta'];
    } else {
        if (data['obj']['alert'] == 'warning') {
            alertForm(className, 'Aviso!', data['msg']);
        } else {
            alertForm(className, 'Error!', data['msg']);
        }
    }
}

function appointmentDelete(aId) {
    post({ id: aId }, "Appointments/appointmentDelete", responseAppoinmentDelete);
}

function responseAppoinmentDelete(response) {
    var data = eval(response);

    if (data['status'] === true) {
        appointmentsTable.row(jQuery('#' + data['obj']).parents('tr')).remove();
        appointmentsTable.draw();
        swal("Exito!", data['msg'], "success");
    } else {
        swal("Error!", data['msg'], "error");
    }
}

function responseAppointmentProduct(response) {
    var data = eval(response);
    var p = data['obj'];

    if (data['status'] == 'added') {
        var p_dom = '<tr id="spa-' + p['id_producto_consulta'] + '">';
        p_dom += '<td><input type="hidden" class="sp-ap" value="' + p['id_producto_consulta'] + '">' + p['nombre_producto'] + '</td>';
        p_dom += '<td><input class="sp-price" type="hidden" value="' + p['precio_producto_pc'] + '">$<span class="sp-price">' + p['precio_producto_pc'] + '</span></td>';
        p_dom += '<td><input class="sp-count" type="hidden" value="' + p['cantidad_producto_pc'] + '">' + p['cantidad_producto_pc'] + '</td>';
        p_dom += '<td data-p="' + p['id_producto'] + '" data-type="delete" data-id="' + p['id_producto_consulta'] + '" class="text-center"><button type="button" class="btn btn-sm btn-danger btn-sp-delete"><i class="fa fa-trash"></i></button></td>';
        p_dom += '</tr>';
        jQuery('#search-added-products tbody').append(p_dom);

        notification('Exito!', 'Producto agregado al recetario', 'info', 2000);
    } else {
        notification('Exito!', 'Producto eliminado del recetario', 'warning', 2000);
        jQuery('#spa-' + p['id_producto_consulta']).remove();
    }
}