<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointments extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('Mdl_Appointments', 'Mdl_Persons', 'Mdl_AppointmentStates', 'Mdl_AppointmentProducts', 'Mdl_Products', 'Mdl_AppointmentHistory', 'Mdl_Recipes'));
	}

/**
 * [index description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function index(){
		isLogin();

		$data['nav'] = 'appointment';
		$data['appointments'] = $this->Mdl_Appointments->appointmentGet(array(1,2), true);
		$this->load->view('pages/appointments/list_appointment', $data);
	}

/**
 * [appointmentAdd description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function appointmentAdd($person = null){
		isLogin();

		$data['nav'] = 'appointment';
		$p = $this->Mdl_Persons->getPerson($person);

		if ($p != false) {
			$data['appointment'] = $p;
		}
		
		$data['states'] = $this->Mdl_AppointmentStates->getAppointmentStates();
		$this->load->view('pages/appointments/add_appointment', $data);
	}

/**
 * [appointmentUpdate description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $id_appointment [description]
 * @return [type]                 [description]
 */
	function appointmentUpdate($id_appointment){
		isLogin();

		$data['nav'] = 'appointment';
		$data['states'] = $this->Mdl_AppointmentStates->getAppointmentStates();
		$data['appointment'] = $this->Mdl_Appointments->appointmentGetId($id_appointment);
		$this->load->view('pages/appointments/add_appointment', $data);
	}

/**
 * [appointmentSave description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function appointmentSave(){
		isLogin(1);

		if ($this->input->post()) {
			$post = $this->input->post();
			$appointment = $this->Mdl_Appointments->appointmentGetId($post['id_consulta']);
			$data['fecha_hora_consulta'] = date('Y-m-d', strtotime($post['fecha_consulta'])). ' '.$post['hora_consulta'].':00';

			$this->appointmentValidate($data, $appointment);

			$data['id_consulta'] = $post['id_consulta'];
			$data['id_persona'] = $post['id_persona']; 
			$data['valor_consulta'] = $post['valor_consulta'];
			$data['estado_consulta'] = 1;

			if ($appointment == false) {
				$appointment = $this->Mdl_Appointments->appointmentAdd($data);
				$appointment['action'] = 'create';
				$status = 'agendada';
			} 
			else{
				$appointment = $this->Mdl_Appointments->appointmentUpdate($data);
				$appointment['action'] = 'update';
				$status = 'modificada';
			}

			// Add new patient to sync list
			//addSync($appointment['id_consulta'], 'appointment');

			$appointment['alert'] = 'success';
			responder($appointment, true, 'Consulta '.$status.' exitosamente');
		}
	}

	function updateRecipe($data){
		$recipe = $this->Mdl_Recipes->getByAppointment($data['id_consulta']);
		$new['id_consulta'] = $data['id_consulta'];
		$new['fecha_recetario'] = date('Y-m-d');
		if(isset($data['detalles_recetario'])){
		    $new['texto_recetario'] = $data['detalles_recetario'];
		}
		

		if(!$recipe){
			$person = $this->Mdl_Persons->getPerson($this->Mdl_Appointments->appointmentGetId($data['id_consulta'])['id_persona']);
			
			$new['paciente_recetario'] = $person['nombre_persona'] . ' ' . $person['apellidos_persona'];
			$this->Mdl_Recipes->add($new);
		}
		else{
			$this->Mdl_Recipes->updateAppointment($new);
		}

	}

/**
 * [appointmentValidate description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $data        [description]
 * @param  [type] $appointment [description]
 * @return [type]              [description]
 */
	function appointmentValidate($data, $appointment){
		$validate = $this->Mdl_Appointments->appointmentValidateDate($data['fecha_hora_consulta']);
		$status = true;
		if ($validate != false) {
			if ($appointment == false) {
				$status = false;
			}
			else{
				if (count($validate) == 1 && $validate[0]['id_consulta'] != $appointment['id_consulta']) {
					$status = false;
				}
				else if(count($validate) > 1){
					$status = false;
				}
			}
		}

		if (!$status) {
			$date_time = explode(' ', $validate[0]['fecha_hora_consulta']);
			responder(array('alert' => 'warning'), false, 'Existe una consulta '.$validate[0]['descripcion_estado_consulta']. ' con el paciente '.$validate[0]['nombre_persona'].' '.$validate[0]['apellidos_persona'].' el '. date('d M, Y', strtotime($date_time[0])). ' a las '.date('h:i a', strtotime($date_time[1])));
		}
	}

/**
 * [appointmentDelete description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function appointmentDelete(){
		isLogin(1);

		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$a = $this->Mdl_Appointments->appointmentGetId($id);

			if ($a === false) {
				responder(false, false, "No se ha encontrado la consulta ");
			}
			else{
				if ($this->Mdl_Appointments->appointmentDelete($id)) {
					// Add new patient to sync list
					//addSync($a['id_consulta'], 'appointment');
					responder($id, true, "Registro eliminado exitosamente");
				}
				else{
					responder($a, true, "Ha ocurrido un error, por favor intente de nuevo más tarde");
				}
			}
		}
		else{
			responder(false, false, "Acceso denegado");
		}
	}

/**
 * 
 */
	function show($id)
	{
		isLogin();

		$data['nav'] = 'appointments';
		$data['ap'] = $this->Mdl_Appointments->appointmentGetId($id);
		$data['person'] = $this->Mdl_Persons->getPerson($data['ap']['id_persona']);
		$data['products'] = $this->Mdl_AppointmentProducts->getAppointmentProducts($id);
		$data['h'] = $this->Mdl_AppointmentHistory->all($id);

		if ($data['ap'] == false) {
			redirect(base_url().'Appointments');
		}

		$this->load->view('pages/appointments/show', $data);
	}

	function appointmentProduct()
	{
		isLogin(1);

		$data = $this->input->post();

		$p = $this->Mdl_Products->get($data['d']['id_producto']);
		$a = $this->Mdl_Appointments->appointmentGetId($data['d']['id_consulta']);
		if ($p != false && $a != false) 
		{
			$prod = $this->Mdl_Products->getOnlyProduct($data['d']['id_producto']);

			if($data['type'] == 'delete')
			{
				$prod['stock_producto'] = $prod['stock_producto'] + $data['d']['cantidad_producto_pc'];
				$this->Mdl_AppointmentProducts->deleteAppointmentProduct($data['d']['id_producto_consulta']);
				$ap['id_producto_consulta'] = $data['d']['id_producto_consulta'];
				$status = 'deleted';
				// Add new product to sync list
				addSync($ap['id_producto_consulta'], 'product_appointment', 'delete');
			}
			else{
				$prod['stock_producto'] = $prod['stock_producto'] - $data['d']['cantidad_producto_pc'];
				$ap = $this->Mdl_AppointmentProducts->addAppointmentProduct($data['d']);
				$status = 'added';
				// Add new product to sync list
				addSync($ap['id_producto_consulta'], 'product_appointment', 'add');
			}

			$this->Mdl_Products->update($prod);
			responder($ap, $status, '');
		}
		else
		{
			responder(false, false, 'No se ha encontrado el producto');
		}
	}

	function saveHistory($data, $_FILE){
		isLogin();

		if ($data) {
			unset($data['detalles_recetario']);
			unset($data['observaciones']);
			$ap = $this->Mdl_AppointmentHistory->all($data['id_consulta']);
			$path = './uploads/history/'.$data['id_consulta'].'/';
			$file = upload_file($_FILE['file'], $path, 'ap_document_history');
			
			if ($file != false) {
				$data['documento_historia_clinica'] = $file;
			}

			if($ap == false)
			{
				$ap = $this->Mdl_AppointmentHistory->add($data);
			}
			else{
				$ap = $this->Mdl_AppointmentHistory->update($data);
			}
		}
	}


	function saveObservations($data){
		isLogin();
		unset($data['files']);
		unset($data['detalles_historia_clinica']);
		$this->updateRecipe($data);
		$appointment = $this->Mdl_Appointments->appointmentUpdate($data);
		$this->session->set_flashdata('text', 'Consulta modificada exitosamente');
		$this->session->set_flashdata('type', 'bg-success');
		$this->session->set_flashdata('title', 'Exito!');
	}

	function saveAllPatientAppoinmentInformation(){
		isLogin();
		$data = $this->input->post();
		if ($data) {
			$ap =$this->Mdl_Appointments->appointmentGetId($data['id_consulta']);
			if ($ap == false) {
				redirect(base_url().'Appointments');
			}

			$this->saveObservations($data);
			$this->saveHistory($data, $_FILES);
			redirect(base_url().'Appointments/show/'.$data['id_consulta']);
		}
		else{
			redirect(base_url().'Appointments/show/'.$data['id_consulta']);
		}
	}
}
