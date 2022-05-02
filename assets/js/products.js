var productsTable;
jQuery(document).ready(function(){
	productsTable = jQuery('#products-list').DataTable({
		iDisplayLength: 25,
		"language": 
		{
		    "url": base_url + "assets/js/datatable-spanish.json"
		},
		order: [],
	}) 
})

jQuery(document).on('change', '#search-category', function(){
	productsTable.search( this.value ).draw();
})

jQuery(document).on('click', '.btn-delete-product', function(){
    var id = jQuery(this).attr('p-id');

    swal({
        title: '¿Esta seguro?',
        text: 'Desea eliminar el producto',
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        cancelButtonColor: "#DD6B55",
        confirmButtonText: "Si, Continuar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false
    }, function(isConfirm){
        if(isConfirm) {
            productDelete(id);
        }
    })
})

jQuery(document).on('click', '.btn-sp-new', function(){
	var name = jQuery(this).parents('td').attr('data-name');
	var temp = jQuery("#detalles-recetario").val();
	$('.summernote').summernote('code', 'niko');
})

jQuery(document).on('click', '#btn-search-products', function(){
	var query = jQuery('#input-search-products').val();
	if(query.length > 1)
	{
		post({q : query}, "Products/search", responseProductsSearch);
	}
	else{
		jQuery('#search-products tbody').html('');
		notification('Error!', 'Por favor escriba una palabra', 'error');
	}
})

jQuery(document).on('keyup', '.recipe-product #input-search-products', function(){
	var query = jQuery('#input-search-products').val();
	if(query.length > 1)
	{
		post({q : query}, "Products/search", responseProductsSearch);
	}
	else{
		jQuery('#search-products tbody').html('');
	}
})

jQuery(document).on('keyup', '.invoice-product #input-search-products', function(){
	var query = jQuery('#input-search-products').val();
	if(query.length > 1)
	{
		post({q : query}, "Products/search", responseProductsSearchInvoice);
	}
	else{
		notification('Error!', 'Por favor escriba una palabra', 'error');
	}
})

jQuery(document).on('click', '#btn-search-products-invoice', function(){
	var query = jQuery('#input-search-products').val();
	if(query.length > 1)
	{
		post({q : query}, "Products/search", responseProductsSearchInvoice);
	}
	else{
		notification('Error!', 'Por favor escriba una palabra', 'error');
	}
})

function productDelete(pId){
	post({id : pId}, "Products/delete", responseProductDelete);
}

function responseProductDelete(response){
	var data = eval(response);

	if (data['status'] === true) {
		productsTable.row(jQuery('#' + data['obj']).parents('tr')).remove();
		productsTable.draw();
		swal("Exito!", data['msg'], "success");
	}
	else{
		swal("Error!", data['msg'], "error");
	}
}

// function responseProductsSearchInvoice(response)
// {
// 	var data = eval(response);

// 	jQuery('#search-products tbody').html('');

// 	if(data['obj'] != false){
// 		for (let i = 0; i < data['obj'].length; i++) {
// 			const p = data['obj'][i];
// 			var p_dom =  '<tr id="sp-'+p['id_producto']+'">';
// 				p_dom += '<td>'+p['nombre_producto']+'</td>';
// 				p_dom += '<td>$'+p['precio_producto']+'</td>';
// 				p_dom += '<td>'+p['stock_producto']+'</td>';
// 				p_dom += '<td  data-type="add" data-p="'+p['id_producto']+'" data-name="'+p['nombre_producto']+'" class="text-center"><button type="button" class="btn btn-sm btn-success btn-sp-new"><i class="fa fa-plus"></i></button></td>';
// 				p_dom += '</tr>';
// 				jQuery('#search-products tbody').append(p_dom);
// 		}
// 	}
// 	else{
// 		var p_dom =  '<tr"><td colspan="4">No se ha encontrado ningun producto</td></tr>';
// 		jQuery('#search-products tbody').html(p_dom);
// 	}
// }

function responseProductsSearch(response)
{
	var data = eval(response);

	jQuery('#search-products tbody').html('');

	if(data['obj'] != false){
		for (let i = 0; i < data['obj'].length; i++) {
			const p = data['obj'][i];
			var p_dom =  '<tr id="sp-'+p['id_producto']+'">';
				p_dom += '<td><input style="width:100%;margin:0;" readonly value="'+p['nombre_producto']+'"></td>';
				p_dom += '<td>$'+p['precio_producto']+'</td>';
				p_dom += '<td>'+p['stock_producto']+'</td>';
				// p_dom += '<td  data-type="add" data-p="'+p['id_producto']+'" data-name="'+p['nombre_producto']+'" class="text-center"><button type="button" class="btn btn-sm btn-success btn-sp-new"><i class="fa fa-plus"></i></button></td>';
				p_dom += '</tr>';
				jQuery('#search-products tbody').append(p_dom);
		}
	}
	else{
		var p_dom =  '<tr"><td colspan="4">No se ha encontrado ningun producto</td></tr>';
		jQuery('#search-products tbody').html(p_dom);
	}
}

function responseProductsSearchInvoice(response)
{
	var data = eval(response);

	jQuery('#search-products tbody').html('');

	if(data['obj'] != false){
		for (let i = 0; i < data['obj'].length; i++) {
			const p = data['obj'][i];
			var p_dom =  '<tr id="sp-'+p['id_producto']+'">';
				p_dom += '<td>'+p['nombre_producto']+'</td>';
				p_dom += '<td>$<input class="sp-price" type="number" value="'+p['precio_producto']+'"></td>';
				p_dom += '<td><input class="sp-count" max="'+p['stock_producto']+'" type="number" value="1"></td>';
				p_dom += '<td>'+p['stock_producto']+'</td>';
				p_dom += '<td  data-type="add" data-p="'+p['id_producto']+'" class="text-center"><button type="button" class="btn btn-sm btn-success btn-spi"><i class="fa fa-plus"></i></button></td>';
				p_dom += '</tr>';
				jQuery('#search-products tbody').append(p_dom);
		}
	}
	else{
		var p_dom =  '<tr"><td colspan="4">No se ha encontrado ningun producto</td></tr>';
		jQuery('#search-products tbody').html(p_dom);
	}
}