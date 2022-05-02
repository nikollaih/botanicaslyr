<?php

if (!function_exists('appointmentsDay')) {
    function appointmentsDay($date){
        $CI = & get_instance();  //get instance, access the CI superobject
        $CI->load->model("Mdl_Appointments");
        
        $init = $date.' 00:00:00';
        $end = $date.' 23:59:59';
        $a = $CI->Mdl_Appointments->appointmentDate($init, $end, array(1,2));
        return $a;
    }
}