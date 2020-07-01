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

	function getAdminByID($id){
		$this->db->where('id', $id);
        if($data = $this->db->get('admin')){
			return $data->row_array();
		}else{
			return false;
		}
	}
	
	function addAdmin($data){
        if($this->db->insert('admin', $data)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	function setAdmin($id,$data){
        $this->db->where('id', $id);
		if($this->db->update('admin', $data)){
			return true;
		}else{
			return false;
		}
    }
	
	function delAdmin($id){
		if($this->db->delete('admin',array('id' => $id))){
			return true;
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