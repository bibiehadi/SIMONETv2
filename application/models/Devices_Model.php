<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Devices_Model extends CI_Model {

    function addDevice($data){
        $this->db->insert('devices', $data);
    }

    function getDevices(){
        if($data = $this->db->get('devices')){
			return $data->result_array();
		}else{
			return false;
		}
    }

    function getDevice($serial){
        $this->db->where($serial);
        if($data = $this->db->get('devices')){
			return $data->row_array();
		}else{
			return false;
		}
    }

    function syncDataDevice($identity,$data){
        try{
            foreach($data as $device){
                $this->db->where('serial_number', $identity['serial_number']);
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

    function getInterfaces($serial){
        $this->db->where($serial);
        if($data = $this->db->get('interfaces')){
			return $data->result_array();
		}else{
			return false;
		}
    }

    function syncInterfaces($data,$serial){
        try{
            foreach($data as $interface){
                if(!isset($interface['default'])){
                    $this->db->query("insert into interfaces(name,mac_address,serial_number,rx_byte,tx_byte)
                    values ('".$interface['name']."','".$interface['mac-address']."','".$serial."','".$interface['rx-byte']."','".$interface['tx-byte']."') 
                    ON DUPLICATE KEY UPDATE name = '".$interface['name']."', mac_address = '".$interface['mac-address']."', serial_number = '".$serial."', rx_byte = '".$interface['rx-byte']."', tx_byte = '".$interface['tx-byte']."'");
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }

    function updateIP($data){
        $this->db->where('serial_number', $data['serial']);
        $this->db->where('name', $data['name']);
        $this->db->update('interfaces', array('address' => $data['address']));
    }

    function updateStatus($ip,$data){
        $this->db->where('main_address4', $ip);
        $this->db->update('devices', $data);
    }

    function delDevice($serial){
        if ($this->db->delete('devices',array('serial_number' => $serial))){
            return true;
        }else{
            return false;
        }
    }


    function delInterfaces($serial){
        if($this->db->delete('interfaces',array('serial_number' => $serial))){
            return true;
        }else{
            return false;
        }
    }
}

/* End of file Devices_Model.php */
