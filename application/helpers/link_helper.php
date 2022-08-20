<?php
// TODO PERSONS ROUTES
function person_modify_link($id){
	return base_url().'persons/updatePatient/'.$id;
}

function person_list_link($limit = false){
    if($limit != false){
        return base_url().'persons/patientsList/true';
    }
    else{
        return base_url().'persons/patientsList';   
    }
}

function person_add_link(){
	return base_url().'persons/addPatient';
}

function person_profile_link($id){
	return base_url().'persons/profile/'.$id;
}


// TODO APPOINTMENTS ROUTES
function appointment_add_link($p = null){
	if ($p == null) {
		return base_url().'appointments/appointmentAdd';
	}
	return base_url().'appointments/appointmentAdd/'.$p;
}

function appointment_update_link($id){
	return base_url().'appointments/appointmentUpdate/'.$id;
}

function appointment_list_link($limit = false){
    if($limit != false){
        return base_url().'appointments/index/true';
    }
    else{
        return base_url().'appointments'; 
    }
}

function appointment_show_link($id){
	return base_url().'appointments/show/'.$id;
}

function invoice_general_link($id){
	return base_url().'files/general/'.$id;
}

function invoice_appointment_link($id){
	return base_url().'files/appointment/'.$id;
}

function invoice_products_link($id){
	return base_url().'files/products/'.$id;
}

function recipe_book_products_link($id){
	return base_url().'files/recipe/'.$id.'/'.generateToken(10);;
}


// TODO PRODUCTS ROUTES
function product_add_link(){
	return base_url().'products/add';
}

function product_update_link($id){
	return base_url().'products/update/'.$id;
}

function product_list_link(){
	return base_url().'products';
}

function product_image_src($id, $img_name){
	$path = base_url().'uploads/products/'.$id.'/'.$img_name;

	if(empty($img_name) || file_exists($path)){
		$path = base_url().'assets/img/no_image.png';
	}

	return $path;
}

// TODO SCHEDULE ROUTES
function schedule_add_link(){
	return base_url().'schedules/add';
}

function schedule_list_link(){
	return base_url().'schedules';
}

// TODO AUTH ROUTES
function logout_link(){
	return base_url().'Auth/logout';
}

// TODO INVOICE ROUTES
function invoice_list_link(){
	return base_url().'Invoices';
}

function invoice_add_link($p = null, $a = null){
	$link = "";
	if($p == null){
		$link = base_url().'Invoices/add';
	}
	else{
		$link = base_url().'Invoices/add/'.$p;
	}

	if($a != null){
		$link .= '/'.$a;
	}

	return $link;
}

function invoice_update_link($id){
	return base_url().'Invoices/edit/'.$id;
}

function invoice_file_link($id){
	return base_url().'Files/invoice/'.$id;
}

// TODO RECIPES ROUTES
function recipe_list_link($limit = false){
    if($limit != false){
        return base_url().'Recipes/index/true';
    }
    else{
        return base_url().'Recipes';
    }
}

function recipe_add_link(){
	return base_url().'Recipes/add';
}

function recipe_update_link($id){
	return base_url().'Recipes/update/'.$id;
}

function recipe_file_link($id){
	return base_url().'Files/recipeOut/'.$id.'/'.generateToken(10);
}

// ASCLEPIOS ROUTES
function asclepio_list_link($limit = false){
    if($limit != false){
        return base_url().'Asclepios/index/true';
    }
    else{
        return base_url().'Asclepios';
    }
}

function asclepio_add_link(){
	return base_url().'Asclepios/add';
}

function asclepio_update_link($id){
	return base_url().'Asclepios/update/'.$id;
}


// EVOLUTION
function evolution_link($id){
	return base_url().'Files/evolution/'.$id.'/'.generateToken(10);
}

// HISTORIA CLINICA
function historia_clinica_link($id){
	return base_url().'Files/historiaClinica/'.$id;
}