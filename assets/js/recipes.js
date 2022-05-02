var recipesTable;
jQuery(document).ready(function(){
	recipesTable = jQuery('#recipe-list').DataTable({
		iDisplayLength: 25,
		"language": 
		{
		    "url": base_url + "assets/js/datatable-spanish.json"
		},
		order: [],
	}) 
})

jQuery(document).on('click', '.btn-delete-recipe', function(){
	var id = jQuery(this).attr('r-id');

    swal({
        title: '¿Esta seguro?',
        text: 'Desea eliminar el recetario',
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        cancelButtonColor: "#DD6B55",
        confirmButtonText: "Si, Continuar!",
        cancelButtonText: "No, Cancelar!",
        closeOnConfirm: false
    }, function(isConfirm){
        if(isConfirm) {
            recipeDelete(id);
        }
    })
})

function recipeDelete(recipeId){
	post({id : recipeId}, "Recipes/recipeDelete", responseRecipeDelete);
}

function responseRecipeDelete(response){
	var data = eval(response);
	if (data['status'] === true) {
		recipesTable.row(jQuery('#' + data['obj']).parents('tr')).remove();
		recipesTable.draw();
		swal("Exito!", data['msg'], "success");
	}
	else{
		swal("Error!", data['msg'], "error");
	}
}