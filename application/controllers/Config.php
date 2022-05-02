<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Config extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('auth'));
		$this->load->model(array('Mdl_Config'));
	}

/**
 * [validateUser description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	public function getConfig($config_name){

		$data = $this->Mdl_Config->getConfig($config_name);
		responder($data, true, $config_name);
    }
    
    public function setConfig($name, $value){
        $data["nombre_configuracion"] = $name;
        $data["valor_configuracion"] = $value;
        $this->Mdl_Config->setConfig($data);
		responder($data, true, "");
	}
}