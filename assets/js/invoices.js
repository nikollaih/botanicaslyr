var invoicesTable;
jQuery(document).ready(function(){
	invoicesTable = jQuery('#invoice-list').DataTable({
		iDisplayLength: 25,
		"language": 
		{
		    "url": base_url + "assets/js/datatable-spanish.json"
		},
		order: [],
	}) 
})

jQuery(document).on('click', '.btn-delete-invoice', function(){
	var idInvoice = jQuery(this).attr('i-id');

    swal({
        title: '¿Esta seguro?',
        text: 'Desea eliminar la factura',
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        cancelButtonColor: "#DD6B55",
        confirmButtonText: "Si, Continuar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false
    }, function(isConfirm){
        if(isConfirm) {
            invoiceDelete(idInvoice);
        }
    })
})

function invoiceDelete(invoiceId){
	post({id : invoiceId}, "Invoices/invoiceDelete", responseInvoiceDelete);
}

function responseInvoiceDelete(response){
	var data = eval(response);
	if (data['status'] === true) {
		invoicesTable.row(jQuery('#' + data['obj']).parents('tr')).remove();
		invoicesTable.draw();
		swal("Exito!", data['msg'], "success");
	}
	else{
		swal("Error!", data['msg'], "error");
	}
}


jQuery(document).on('click', '.btn-spi', function(){
	var idP = jQuery(this).parents('td').attr('data-p');
	var dType = jQuery(this).parents('td').attr('data-type');

	post({d:{
				id_producto : idP,
				id_factura : jQuery('#id-factura').val(),
				valor_productos_factura : jQuery('#sp-' + idP).find('.sp-price').val(),
				cantidad_productos_factura : jQuery('#sp-' + idP).find('.sp-count').val(),
				id_productos_factura : 'null'
			},
			type : dType
		}, 
		"Invoices/addProduct", 
		responseInvoiceProduct
	);
})

jQuery(document).on('click', '.btn-spi-delete', function(){
	var idP = jQuery(this).parents('td').attr('data-p');
	var dType = jQuery(this).parents('td').attr('data-type');
	var idPA = jQuery(this).parents('td').attr('data-id');

	post({d:{
				id_producto : idP,
				id_factura : jQuery('#id-factura').val(),
				id_productos_factura : idPA,
				cantidad_productos_factura : jQuery('#spa-' + idPA).find('.sp-count').val(),
			},
			type : dType
		}, 
		"Invoices/addProduct", 
		responseInvoiceProduct
	);
})


function responseInvoiceProduct(response){
	var data = eval(response);
	var p = data['obj'];

	if(data['status'] == 'added')
	{
		var p_dom =  '<tr id="spa-'+p['id_productos_factura']+'">';
		p_dom += '<td><input type="hidden" class="sp-ap" value="'+p['id_productos_factura'] +'">'+p['nombre_producto']+'</td>';
		p_dom += '<td><input class="sp-price" type="hidden" value="'+p['valor_productos_factura'] +'">$<span class="sp-price">'+p['valor_productos_factura']+'</span></td>';
		p_dom += '<td><input class="sp-count" type="hidden" value="'+p['cantidad_productos_factura'] +'">'+p['cantidad_productos_factura']+'</td>';
		p_dom += '<td data-p="'+p['id_producto']+'" data-type="delete" data-id="'+p['id_productos_factura']+'" class="text-center"><button type="button" class="btn btn-sm btn-danger btn-spi-delete"><i class="fa fa-trash"></i></button></td>';
		p_dom += '</tr>';
		jQuery('#search-added-products tbody').append(p_dom);

		notification('Exito!', 'Producto agregado a la factura', 'info', 2000);
	}
	else{
		notification('Exito!', 'Producto eliminado de la factura', 'warning', 2000);
		jQuery('#spa-'+p['id_productos_factura']).remove();
	}
}