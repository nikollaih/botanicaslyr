<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Persons extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('Mdl_Persons', 'Mdl_Appointments', 'Mdl_AppointmentHistory'));
		$this->load->helper(array('url', 'auth','sync'));
	}

/**
 * [addPatient description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 */
	function addPatient(){
		isLogin();

		$data['nav'] = "add-patient";
		$this->load->view('pages/persons/add_person', $data);
	}

/**
 * [updatePatient description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
	function updatePatient($id = null){
		isLogin();

		$data['nav'] = "patient";
		$data['person'] = $this->Mdl_Persons->getPerson($id);
		($data['person'] == false) ? redirect(base_url().'persons/addPatient') : true;
		$this->load->view('pages/persons/add_person', $data);
	}

/**
 * [savePerson description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function savePerson(){
		isLogin(1);
		if ($this->input->post()) {
			$data = $this->input->post();
			$person = $this->Mdl_Persons->getPerson($data['id_persona']);
    
			if ($person == false) {
				$doc_exists = $this->Mdl_Persons->getPersonDocument($data['numero_documento']);
				
				if ($doc_exists != false) {
					$doc_exists['estado_persona'] = 1;
					$this->Mdl_Persons->updatePerson($doc_exists);
					responder(array('alert' => 'warning'), false, "El número de documento ya se encuentra en uso, por favor verifique la lista de pacientes");
				}

				//$data['fecha_nacimiento_persona'] = date('Y-m-d', strtotime($data['fecha_nacimiento_persona']));
				
				$data['created_at'] = date('Y-m-d H:i:s');
				$person = $this->Mdl_Persons->addPerson($data);
				$person['state'] = "add";
				$status = "agregado";
			}
			else{
				$person = $this->Mdl_Persons->updatePerson($data);
				$person['state'] = "update";
				$status = "modificado";
			}
			

			if ($person != false) {
				// Add new patient to sync list
				// addSync($person['id_persona'], 'person', 'add');
				$person['alert'] = "success";
				$this->session->set_flashdata('title', 'Exito!');
				$this->session->set_flashdata('type', 'bg-success');
				$this->session->set_flashdata('text', 'Paciente '.$status.' exitosamente');
				responder($person, true, "Paciente ".$status." exitosamente");
			}
			else{
				$person['alert'] = "danger";
				$this->session->set_flashdata('type', 'bg-danger');
				$this->session->set_flashdata('text', 'Ha ocurrido un error, por favor intente de nuevo más tarde');
				$this->session->set_flashdata('title', 'Error!');
				responder($person, false, "Ha ocurrido un error, por favor intente de nuevo más tarde");
			}
		}
		else{
			responder(0, false, "Acceso denegado");
		}
	}

/**
 * [patientsList description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function patientsList($limit = false){
		isLogin();

		$data['nav'] = "patient";
		$data['persons'] = $this->Mdl_Persons->getPersonsType(2, $limit);
		$this->load->view('pages/persons/list_person', $data);
	}


/**
 * [personDelete description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function personDelete(){
		isLogin(1);

		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$person = $this->Mdl_Persons->getPerson($id);

			if ($person === false) {
				responder(false, false, "No se ha encontrado la persona");
			}
			else{
				if ($this->Mdl_Persons->personDelete($id)) {
					// Add new patient to sync list
					addSync($person['id_persona'], 'person', 'delete');
					responder($id, true, "Registro eliminado exitosamente");
				}
				else{
					responder($person, true, "Ha ocurrido un error, por favor intente de nuevo más tarde");
				}
			}
		}
		else{
			responder(false, false, "Acceso denegado");
		}
	}

/**
 * [personInfo description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */ 
	function personInfo(){
		isLogin(1);

		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$person = $this->Mdl_Persons->getPerson($id);

			if ($person === false) {
				responder(false, false, "No se ha encontrado la persona");
			}
			else{
				responder($person, true, "Información del paciente");
			}
		}
		else{
			responder(false, false, "Acceso denegado");
		}
	}

/**
 * [personInfoDocument description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function personInfoDocument(){
		isLogin(1);

		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$person = $this->Mdl_Persons->getPersonDocument($id);

			if ($person === false) {
				responder(false, false, "No se ha encontrado la persona");
			}
			else{
				responder($person, true, "Información del paciente");
			}
		}
		else{
			responder(false, false, "Acceso denegado");
		}
	}


	function personSearch($cant = false){
		isLogin(1);

		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$person = $this->Mdl_Persons->getPersonSearch($id, $cant);

			if ($person === false) {
				responder(false, false, "No se ha encontrado la persona");
			}
			else{
				responder($person, true, "Información del paciente");
			}
		}
		else{
			responder(false, false, "Acceso denegado");
		}
	}

	function profile($id){
		isLogin();

		$data['nav'] = 'patient';
		$data['person'] = $this->Mdl_Persons->getPerson($id);
		$data['appointments'] = $this->Mdl_Appointments->appointmentsGetPatient($id);
		$data["historiaClinica"] = $this->Mdl_AppointmentHistory->getByPerson($id);
		$this->load->view('pages/persons/profile', $data);
	}
}