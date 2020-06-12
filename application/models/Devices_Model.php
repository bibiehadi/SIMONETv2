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

    function getDevicesByStatus(){
        if($data = $this->db->get('devices')){
			return $data->result_array();
		}else{
			return false;
		}
    }

    function getDevicesByMaster($id){
        $this->db->where($id);
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
        $this->db->select('address');
        $this->db->where('platform','MikroTik');
        $this->db->or_where('platform','MikroTik Switch');
        $_ip = array();
        if($data = $this->db->get('devices')){
            $result = $data->result_array();
			foreach($result as $ip){
                $_ip[] = $ip['address'];
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
        if($data = $this->db->get('devices_user')){
			return $data->row_array();
		}else{
			return false;
		}
    }

    function getLastesROS(){
        $this->db->where(array('id' => '1'));
        if($data = $this->db->get('devices_configuration')){
            $result = $data->result_array();
            return $result[0]['script'];
        }else{
            return false;
        }
    }

    function getInterfaces($id){
        $this->db->where($id);
        if($data = $this->db->get('device_interfaces')){
			return $data->result_array();
		}else{
			return false;
		}
    }

    function syncInterfaces($data,$id_device){
        try{
            foreach($data as $interface){
                if(!isset($interface['default'])){
                    $this->db->query("insert into device_interfaces(id_interface,name,mac_address,id_device,rx_byte,tx_byte)
                    values ('".$interface['.id']."','".$interface['name']."','".$interface['mac-address']."','".$id_device."','".$interface['rx-byte']."','".$interface['tx-byte']."') 
                    ON DUPLICATE KEY UPDATE id_interface = '".$interface['.id']."', name = '".$interface['name']."', mac_address = '".$interface['mac-address']."', id_device = '".$id_device."', rx_byte = '".$interface['rx-byte']."', tx_byte = '".$interface['tx-byte']."'");
                }
            }
        }catch(Exception $e){
            return $e;
        }
    }

    function updateIP($data){
        $this->db->where('id_device', $data['id']);
        $this->db->where('name', $data['name']);
        $this->db->update('device_interfaces', array('address' => $data['address']));
    }

    function updateStatus($ip,$data){
        $this->db->where('address', $ip);
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
        if($this->db->delete('device_interfaces',array('id_device' => $id))){
            return true;
        }else{
            return false;
        }
    }

    function reload_table(){
        table.ajax.reload(null,false);
    }
}

/* End of file Devices_Model.php */
