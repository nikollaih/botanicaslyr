var asclepiosTable;
var asclepioId;
jQuery(document).ready(function() {
    asclepiosTable = jQuery('#asclepios-list').DataTable({
        iDisplayLength: 25,
        "language": {
            "url": base_url + "assets/js/datatable-spanish.json"
        },
        order: [],
    })

    jQuery('#asclepios-tabla-modal').DataTable({
        iDisplayLength: 10,
        "language": {
            "url": base_url + "assets/js/datatable-spanish.json"
        }
    })
})

jQuery(document).on('click', '.btn-delete-asclepio', function() {
    var id = jQuery(this).attr('a-id');

    swal({
        title: '¿Esta seguro?',
        text: 'Desea eliminar el asclepio',
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        cancelButtonColor: "#DD6B55",
        confirmButtonText: "Si, Continuar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false
    }, function(isConfirm) {
        if (isConfirm) {
            asclepioDelete(id);
        }
    })
})

function asclepioDelete(asclepioId) {
    post({ id: asclepioId }, "Asclepios/asclepioDelete", responseAsclepioDelete);
}

function responseAsclepioDelete(response) {
    var data = eval(response);
    if (data['status'] === true) {
        asclepiosTable.row(jQuery('#' + data['obj']).parents('tr')).remove();
        asclepiosTable.draw();
        swal("Exito!", data['msg'], "success");
    } else {
        swal("Error!", data['msg'], "error");
    }
}

function setAsclepioId(asclepio_id) {
    asclepioId = asclepio_id;
}

function addAsclepioToSummernote(id_asclepio) {
    $.ajax({
        url: base_url + "Asclepios/get/" + id_asclepio,
        type: 'GET',
        success: function(data) {
            var data = JSON.parse(data);
            console.log(data.obj.descripcion_asclepio);
            if (data.status) {
                $('#' + asclepioId).summernote('pasteHTML', data.obj.descripcion_asclepio);
                $("#asclepios-modal").modal('hide');
            } else {
                swal("Error!", data.message, "success");
            }
        },
        error: function(e) {
            console.log(e);
        }
    });
}