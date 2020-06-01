<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Devices extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')=== null){
            redirect('login');
        }
        $this->load->model('devices_model','devices');
        $this->load->model('mikrotik_model','mikrotik');
    }
    

    public function index()
    {
        $data['discovery'] = $this->discoveryDevices();
        $data['location'] = $this->devices->getLocation();
        $this->load->view('devices_view',$data);
        
    }

    public function detailDevice()
    {
        // function untuk menampilkan halaman detail user hotspot 
        $id = $this->input->post('id');
        $data = $this->devices->getDevice(array('id'=> $id));
        $data['location'] = $this->devices->getLocation();
        $data['list_devices'] = $this->devices->getdevices();
        $data['interfaces'] = $this->devices->getInterfaces(array('id_device'=> $id));
        if($data['status'] == 'Connected'){
            $this->syncIdentities($data['main_address4'],$id);
        }
        // print_r($data);
        $this->load->view('device_detail_view',$data);
        
    }

    function devicesJSON(){
        // funtion untuk mengget semua data user profile dari database
        $data = $this->devices->getdevices();
        $_data = array();
            foreach($data as $r){
                if($r['status'] == 'Connected'){
                    $r['status'] = '<span class="label label-primary">Connected</span>';
                }elseif ($r['status'] == 'Disconnected') {
                    $r['status'] = '<span class="label label-danger">Disconnected </span>';
                }elseif ($r['status'] == 'Reboot') {
                    $r['status'] = '<span class="label label-warning">Reboot </span>';
                }
                $_data[] = $r;
            }
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $_data,
        );
        echo json_encode($output);
    }

    function addDevice(){
        $data = array(
            'serial_number' => $this->input->post('serial'),
            'main_address4' => $this->input->post('address4'),
            'id_location' => $this->input->post('location')
        );
        $this->devices->addDevice($data);
        echo json_encode(array("status" => TRUE));
    }

    function discoveryDevices(){
        $user = $this->devices->getUserRouter(array('id' => '1111'));
        try{
            $api = $this->routerosapi;
            if($api->connect('10.10.10.1',$user['username'],$user['password'])){
                $api->write('/ip/neighbor/print');
                $read = $api->read();
                $api->disconnect();
                // foreach($read as $interface){
                //     if($interface['disabled'] == 'false'){
                //         $_data['address'] = $interface['address'];
                //         $_data['name'] = $interface['actual-interface'];
                //         $_data['serial'] = $serial;
                $ip = $this->devices->getIPDevices();
                foreach($read as $r){
                    if(isset($r['address']) && !in_array($r['address'], $ip)){
                        $r['aksi'] = "<a href='javascript:;' data-aksi='edit' data-address='".$r['address']."'><i class='fa fa-plus'></i></a>";
                        $_data[] = $r;
                    }
                }    
                return $_data;
                // $output = array(
                //     "draw" => $this->input->post('draw'),
                //     "data" => $_data,
                //     );
                // echo json_encode($output);            
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE));
        }
    }

    function syncIdentities($ip,$id){
        // funtion untuk mensyncronise data dari mikrotik ke database
        // $data = $this->devices->getdevices();
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->write('/system/resource/print');
                $read = $api->read();
                $api->disconnect();
                $identity['identity'] = $this->getIdentity($ip);
                $identity['id'] = $id;
                if($identity['identity']!='error'){
                    $this->devices->syncdatadevice($identity,$read);
                }
                // echo json_encode(array("status" => TRUE));
            }else{
                // echo json_encode(array("status" => FALSE, "msg" => 'Gagal terhubung ke Router'.$device['main_address4']));
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE, "msg" => $error));
        }
    }

    function cekDevice($ip){
        // funtion untuk menyimpan data user hotspot ke mikrotik
        $data = $this->devices->getdevices();
        try{
            $connect = 0; $disconnect =0;
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ping',false);
                $api->write('=address='.$ip,false);
                $api->write('=count=5',false);
                $api->write('=interval=0.3');
                $read = $api->read();
                $api->disconnect();
                foreach($read as $result){
                    if($result['packet-loss']>0){
                        $disconnect++;
                    }else{
                        $connect++;
                    }
                }
                if($connect>=1){
                    $this->db->where('serial_number', $device['serial_number']);
                    $this->db->update('devices', array('status' => 'connect'));
                }else{
                    $this->db->where('serial_number', $device['serial_number']);
                    $this->db->update('devices', array('status' => 'disconnect'));
                }
                echo json_encode(array("status" => TRUE));
            }
        }catch(exeption $e){
            echo $e;
        }
    }

    function getIdentity($ip){
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->write('/system/identity/print');
                $read = $api->read();
                $api->disconnect();
                return $read[0]['name'];
            }
        }catch(Exeption $error){
            return 'error';
        }
    }

    function getInterfaces(){
        $ip = $this->input->post('ip');
        $id = $this->input->post('id');
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->write('/interface/print');
                $read = $api->read();
                $api->disconnect();
                $mac=array();
                $same = 0;
                foreach($read as $result){
                    // if($result['mac-address']==$mac){
                    if(in_array($result['mac-address'], $mac)){
                        $same++;
                        $result['mac-address'] = $result['mac-address'].':0'.$same;
                    
                    }else{
                        $mac[] = $result['mac-address'];
                    }
                    $_read[]=$result;
                }
                $this->devices->syncinterfaces($_read,$id);
                echo json_encode(array("status" => TRUE));
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE));
        }
    }

    function getIP(){
        $id = $this->input->post('id');
        $ip = $this->input->post('ip');
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->write('/ip/address/print');
                $read = $api->read();
                $api->disconnect();
                foreach($read as $interface){
                    if($interface['disabled'] == 'false'){
                        $_data['address'] = $interface['address'];
                        $_data['name'] = $interface['actual-interface'];
                        $_data['id'] = $id;
                        $this->devices->updateIP($_data);
                    }
                }
                echo json_encode(array("status" => TRUE));
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE));
        }
    }

    function reboot(){
        $ip = $this->input->post('ip');
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->comm('/system/reboot');
                $api->disconnect();
                $this->devices->updateStatus($ip,array('status' => 'Reboot'));
                echo json_encode(array("status" => TRUE));
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE));
        }
    }

    function delDevice(){
        // funtion menghapus data user hotspot di mikrotik dan database
        $serial = $this->input->post('id');
        if($this->devices->delDevice(array('id' =>$id))){
            if($this->devices->delInterfaces(array('id_device' => $id))){
                echo json_encode(array("status" => TRUE));
            }
        }else{
            echo json_encode(array("status" => FALSE));
        }
        
    }

    function formatBytes($size, $decimals = 0){
        // funtion untuk mengkonversi data menjadi Byte
        $unit = array(
        '0' => 'Byte',
        '1' => 'KB',
        '2' => 'MB',
        '3' => 'GB',
        '4' => 'TB',
        '5' => 'PB',
        '6' => 'EB',
        '7' => 'ZB',
        '8' => 'YB'
        );
        
        for($i = 0; $size >= 1000 && $i <= count($unit); $i++){
        $size = $size/1000;
        }
        return round($size, $decimals).' '.$unit[$i];
    }
}

/* End of file Devices.php */
