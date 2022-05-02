<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('auth'));
		$this->load->model(array('Mdl_Persons'));
	}

/**
 * [login description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	public function login(){
		$this->load->view('pages/auth/login');
	}

/**
 * [validateUser description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function loginUser(){
		$username = $this->input->post('user');
		$pass = $this->input->post('password');

		$id = $this->Mdl_Persons->validateUser($username, $pass);
		if ($id !== false) {
			$person = $this->Mdl_Persons->getPerson($id);
			if ($person !== false) {
				$this->session->set_userdata($person);
				responder($person, true, "Bienvenido!");
			}
			else{
				responder(0, false, "Ha ocurrido un error por favor intenta de nuevo más tarde");
			}
		}
		else{
			responder(0, false, "El usuario no existe");
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}