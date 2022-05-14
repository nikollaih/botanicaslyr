<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Files extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model(array('Mdl_Appointments','Mdl_AppointmentProducts', 'Mdl_Invoices', 'Mdl_Recipes'));
	}

    function general($id){
		$data['products'] = $this->Mdl_AppointmentProducts->getAppointmentProducts($id);
		$data['ap'] = $this->Mdl_Appointments->appointmentGetId($id);
		$this->load->view('pages/files/general', $data);

		$html = $this->output->get_output();
 
		//$this->dompdf->set_option('defaultFont', 'Helvetica');
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');

		$this->dompdf->render();

		// Output the generated PDF to Browser
		$this->dompdf->stream('factura_general_'.$id.'_'.date('Y_m_d').'.pdf', array('Attachment' => 0));
	}
	
	function products($id){
		$data['products'] = $this->Mdl_AppointmentProducts->getAppointmentProducts($id);
		$data['ap'] = $this->Mdl_Appointments->appointmentGetId($id);
		$this->load->view('pages/files/products', $data);

		$html = $this->output->get_output();
 
		//$this->dompdf->set_option('defaultFont', 'Helvetica');
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');

		$this->dompdf->render();

		// Output the generated PDF to Browser
		$this->dompdf->stream('factura_productos_'.$id.'_'.date('Y_m_d').'.pdf', array('Attachment' => 0));
	}

	function appointment($id){
		$data['products'] = $this->Mdl_AppointmentProducts->getAppointmentProducts($id);
		$data['ap'] = $this->Mdl_Appointments->appointmentGetId($id);
		$this->load->view('pages/files/appointment', $data);

		$html = $this->output->get_output();
 
		//$this->dompdf->set_option('defaultFont', 'Helvetica');
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');

		$this->dompdf->render();

		// Output the generated PDF to Browser
		$this->dompdf->stream('factura_consulta_'.$id.'_'.date('Y_m_d').'.pdf', array('Attachment' => 0));
	}

	function recipe($id){
		$data['ap'] = $this->Mdl_Appointments->appointmentGetId($id);
		$this->load->view('pages/files/recipe', $data);

		$html = $this->output->get_output();

		//$this->dompdf->set_option('defaultFont', 'Helvetica');
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->loadHtml($html, 'UTF-8');

		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');

		$this->dompdf->render();

		// Output the generated PDF to Browser
		$this->dompdf->stream('recetario_'.$id.'_'.date('Y_m_d').'.pdf', array('Attachment' => 0));
	}
	
	function evolution($id){
		$data['ap'] = $this->Mdl_Appointments->appointmentGetId($id);
		$this->load->view('pages/files/evolution_sheet', $data);

		$html = $this->output->get_output();
 
		//$this->dompdf->set_option('defaultFont', 'Helvetica');
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->loadHtml($html, 'UTF-8');

		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');

		$this->dompdf->render();

		// Output the generated PDF to Browser
		$this->dompdf->stream('recetario_'.$id.'_'.date('Y_m_d').'.pdf', array('Attachment' => 0));
	}

	function invoice($id){
		$data['products'] = $this->Mdl_Invoices->getProducts($id);
		$data['inv'] = $this->Mdl_Invoices->get($id);
		$this->load->view('pages/files/invoice', $data);

		$html = $this->output->get_output();
 
		//$this->dompdf->set_option('defaultFont', 'Helvetica');
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');

		$this->dompdf->render();

		// Output the generated PDF to Browser
		$this->dompdf->stream('factura_productos_'.$id.'_'.date('Y_m_d').'.pdf', array('Attachment' => 0));
	}

	function recipeOut($id){
		$data['recipe'] = $this->Mdl_Recipes->get($id);
		$this->load->view('pages/files/recipeOut', $data);

		$html = $this->output->get_output();
 
		//$this->dompdf->set_option('defaultFont', 'Helvetica');
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->loadHtml($html, 'UTF-8');

		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');

		$this->dompdf->render();


		// Output the generated PDF to Browser
		$this->dompdf->stream('recetario_'.$id.'_'.date('Y_m_d').'.pdf', array('Attachment' => 0));
	}
}