<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('url', 'auth'));
		$this->load->model(array('Mdl_Schedules', 'Mdl_Persons', 'Mdl_Appointments'));
	}

	public function index()
	{
		isLogin();

		$data['nav'] = "dashboard";
		$data['persons'] = $this->Mdl_Appointments->appointmentGet(0, true);
		$this->load->view('pages/dashboard.php', $data);
	}

	function sync(){
		//sync();
	}

	function search(){
		isLogin();

		if ($this->input->get()) {
			$q = $this->input->get('q');

			$data['q'] = $q;
			$data['nav'] = "schedules";
			$data['search'] = $this->Mdl_Schedules->search($q);
			$this->load->view('pages/schedules/search.php', $data);

		}
	}
}
