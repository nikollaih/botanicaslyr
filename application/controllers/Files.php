<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Files extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Mdl_Persons', 'Mdl_Appointments','Mdl_AppointmentProducts', 'Mdl_Invoices', 'Mdl_Recipes', 'Mdl_AppointmentHistory'));
		
		$fontsFolder = ($_SERVER['HTTP_HOST'] == 'localhost:8888' || $_SERVER['HTTP_HOST'] == 'localhost') ? $_SERVER['DOCUMENT_ROOT'] . '/botanicaslyr/assets/fonts' : $_SERVER['DOCUMENT_ROOT'] . '/assets/fonts';
		$this->mpdfConfig = [
			'mode' => 'c',
        	'format' => 'A4',
			'fontDir' => [
				$fontsFolder,
			],
			'fontdata' => [
				'Courier' => [
					'R' => 'Courier.ttf',
					'I' => 'Courier.ttf',
				]
			],
			'default_font' => 'Courier',
			'debugfonts' => true,
		];
	}

    function general($id){
		$this->load->library('pdf');
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
		$this->load->library('pdf');
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
		$this->load->library('pdf');
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
		$this->load->library('pdf');
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
		$this->load->library('pdf');
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
		$this->load->library('pdf');
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
		$this->load->library('pdf');
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

	function historiaClinica($id_person){
		$mpdf = new \Mpdf\Mpdf($this->mpdfConfig);
		$mpdf->SetWatermarkImage(base_url().'/assets/img/medicina.png');
		$mpdf->showWatermarkImage = true;

		$data["historia_clinica"] = $this->Mdl_AppointmentHistory->getByPerson($id_person);
		$data["persona"] = $this->Mdl_Persons->getPerson($id_person);

		$html = $this->load->view('pages/files/historiaClinica', $data, TRUE);
		$mpdf->WriteHTML($html);
		$mpdf->Output(); // opens in browser
	}
}