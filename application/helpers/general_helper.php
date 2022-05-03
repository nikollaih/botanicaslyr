<?php

/**
 * [responder description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $objeto  [description]
 * @param  [type] $estado  [description]
 * @param  [type] $mensaje [description]
 * @return [type]          [description]
 */
	function responder($objeto = false,$estado = false,$mensaje = ""){
	  	$resultado["obj"]=$objeto;
	  	$resultado["status"]=$estado;
	  	$resultado["msg"]=$mensaje;
	  	echo json_encode($resultado);
	  	die();
	}

	/**
	 * 
	 */
	function person_age($date)
	{
		$now = new DateTime(date('Y-m-d'));
		$date = new DateTime($date);
		$diff = $date->diff($now);
		return $diff->y;
	}

	/**
	 * 
	 */
	function count_patients(){
		$CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("Mdl_Persons");
		$p = $CI->Mdl_Persons->getPersonsType(2);
		
		if ($p == false) {
			return 0;
		} else {
			return count($p);
		}
	}

	function count_products(){
		$CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("Mdl_Products");
		$p = $CI->Mdl_Products->all(array(1,2));
		
		if ($p == false) {
			return 0;
		} else {
			return count($p);
		}
	}

	function count_appointments(){
		$CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("Mdl_Appointments");
		$p = $CI->Mdl_Appointments->appointmentCount(array(1,2));
		
		if ($p == false) {
			return 0;
		} else {
			return count($p);
		}
	}

	function count_shedules(){
		$CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("Mdl_Schedules");
		$p = $CI->Mdl_Schedules->all();
		
		if ($p == false) {
			return 0;
		} else {
			return count($p);
		}
	}

	function count_invoices(){
		$CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("Mdl_Invoices");
		$p = $CI->Mdl_Invoices->all();
		
		if ($p == false) {
			return 0;
		} else {
			return count($p);
		}
	}

	function count_recipes(){
		$CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("Mdl_Recipes");
		$p = $CI->Mdl_Recipes->all();
		
		if ($p == false) {
			return 0;
		} else {
			return count($p);
		}
	}

	function get_asclepios(){
		$CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("Mdl_Asclepio");
		return $CI->Mdl_Asclepio->all();
	}

	function invoiceNumber($n)
	{
		switch (strlen($n)) {
			case 1:
				return '000' . $n;
				break;
			
			case 2:
				return '00' . $n;
				break;
			
			case 3:
				return '0' . $n;
				break;
			
			case 4:
				return $n;
				break;
			
			default:
				return $n;
				break;
		}
	}

function generateToken($length){
		$token = rand(1000,9999);
		return $token;
	}