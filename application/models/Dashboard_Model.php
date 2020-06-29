<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model {

    function getAdmins(){
        if($data = $this->db->get('admin')){
			return $data->result_array();
		}else{
			return false;
		}
    }
    function getDeviceAuth(){
        if($data = $this->db->get('devices_user')){
			return $data->result_array();
		}else{
			return false;
		}
    }

    function getTemplateConfig(){
        if($data = $this->db->get('devices_configuration')){
			return $data->result_array();
		}else{
			return false;
		}
    }

}

/* End of file Dashboard_Model.php */
