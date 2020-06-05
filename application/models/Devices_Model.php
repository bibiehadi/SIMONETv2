<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Devices_Model extends CI_Model {

    function addDevice($data){
        $this->db->insert('devices', $data);
    }

    function setDevice($data){
        $this->db->where('id', $data['id']);
        $this->db->update('devices', $data);
    }

    function getDevices(){
        if($data = $this->db->get('devices')){
			return $data->result_array();
		}else{
			return false;
		}
    }

    function getDevice($id){
        $this->db->where($id);
        if($data = $this->db->get('devices')){
			return $data->row_array();
		}else{
			return false;
		}
    }

    function getIPDevices(){
        $this->db->select('main_address4');
        $this->db->where('platform','MikroTik');
        $this->db->or_where('platform','MikroTik Switch');
        if($data = $this->db->get('devices')){
            $result = $data->result_array();
			foreach($result as $ip){
                $_ip[] = $ip['main_address4'];
            }
            return $_ip;
		}else{
			return false;
		}
    }

    function syncDataDevice($identity,$data){
        try{
            foreach($data as $device){
                $this->db->where('id', $identity['id']);
                $this->db->update('devices', array('uptime' => $device['uptime'], 'version' => $device['version'], 
                'model' => $device['board-name'], 'platform' => $device['platform'], 'identity' => $identity['identity']));
            }
        }catch(Exception $e){
            return $e;
        }
    }

    function getLocation(){
        if($data = $this->db->get('device_location')){
			return $data->result_array();
		}else{
			return false;
		}
    }

    function getUserRouter($id){
        $this->db->where($id);
        if($data = $this->db->get('configuration')){
			return $data->row_array();
		}else{
			return false;
		}
    }

    function getInterfaces($id){
        $this->db->where($id);
        if($data = $this->db->get('interfaces')){
			return $data->result_array();
		}else{
			return false;
		}
    }

    function syncInterfaces($data,$id_device){
        try{
            foreach($data as $interface){
                if(!isset($interface['default'])){
                    $this->db->query("insert into interfaces(name,mac_address,id_device,rx_byte,tx_byte)
                    values ('".$interface['name']."','".$interface['mac-address']."','".$id_device."','".$interface['rx-byte']."','".$interface['tx-byte']."') 
                    ON DUPLICATE KEY UPDATE name = '".$interface['name']."', mac_address = '".$interface['mac-address']."', id_device = '".$id_device."', rx_byte = '".$interface['rx-byte']."', tx_byte = '".$interface['tx-byte']."'");
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }

    function updateIP($data){
        $this->db->where('id_device', $data['id']);
        $this->db->where('name', $data['name']);
        $this->db->update('interfaces', array('address' => $data['address']));
    }

    function updateStatus($ip,$data){
        $this->db->where('main_address4', $ip);
        $this->db->update('devices', $data);
    }

    function delDevice($id){
        if ($this->db->delete('devices',array('id' => $id))){
            return true;
        }else{
            return false;
        }
    }


    function delInterfaces($id){
        if($this->db->delete('interfaces',array('id_device' => $id))){
            return true;
        }else{
            return false;
        }
    }
}

/* End of file Devices_Model.php */
