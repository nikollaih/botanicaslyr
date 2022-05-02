<?php

if (!function_exists('isLogin')) {
    function isLogin($page = 'auth/login', $type = 0){
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->library("session");
        $sess_id = $CI->session->userdata('id_persona');
        if (empty($sess_id)) {
            if ($type == 0) {
                redirect(base_url().$page);
            }
            else{
                responder(0, false, "Acceso denegado");
            }
        } 
        else{
            return true;
        }
    }
}