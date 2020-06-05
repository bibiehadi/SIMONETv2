<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('application/libraries/Client.php');
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
        $data['unifiDevices'] = $this->getUnifiDevices();
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
        if($data['status'] == 'Connected' && $data['platform']=="MikroTik"){
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

    function addDeviceByDiscovery(){
        $data = array(
            'main_address4' => $this->input->post('address'),
            'identity' => $this->input->post('identity'),
            'version' => $this->input->post('version'),
            'uptime' => $this->input->post('uptime'),
            'model' => $this->input->post('board'),
            'platform' => $this->input->post('platform'),
            'status' => $this->input->post('status')
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
                    if(isset($r['address'])){
                        if(!in_array($r['address'], $ip)){
                            $version = explode('.',$r['version']);
                            if($version[0] == '1'){
                                $r['platform'] = "MikroTik Switch";
                            }
                            $r['aksi'] = "<a href='javascript:;' data-aksi='discovery' data-identity='".$r['identity']."' data-uptime='".$r['uptime']."' data-board='".$r['board']."' data-version='".$r['version']."' data-address='".$r['address']."' data-platform='".$r['platform']."' data-status='Connected'><i class='fa fa-plus'></i></a>";
                            $_data[] = $r;
                        }
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

    function setDevice(){
        // function untuk merubah data user hotspot dan menyimpannya ke mikrotik
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        if($this->input->post('identity') != null){
            $data = array(
                'id' => $this->input->post('id'),
                'identity' => $this->input->post('identity'),
                'serial_number' => $this->input->post('serial'),
                'main_address4' => $this->input->post('address'),
                'id_location' => $this->input->post('location')  
            );
            try{
                $api = $this->routerosapi;
                $api->port = 8728;
                if($api->connect($data['main_address4'],$user['username'],$user['password'])){
                    $api->write('/system/identity/set',false);
                    $api->write('=name='.$data['identity']);
                    $write = $api->read();
                    $api->disconnect();
                    $this->devices->setDevice($data);
                    echo json_encode(array("status" => TRUE, "identity" => $write));
                }else{
                    echo json_encode(array("status" => FALSE));
                }
            }catch(exeption $e){
                echo $e;
            }
        }else{
            $data = array(
                'id' => $this->input->post('id'),
                'serial_number' => $this->input->post('serial'),
                'main_address4' => $this->input->post('address'),
                'id_location' => $this->input->post('location')  
            );
            $this->devices->setDevice($data);
            echo json_encode(array("status" => TRUE));
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

    function cekDevice(){
        // funtion untuk menyimpan data user hotspot ke mikrotik
        $data = $this->devices->getdevices();
        try{
            $connect = 0; $disconnect =0;
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ping',false);
                $api->write('=address=10.10.10.135',false);
                $api->write('=count=5',false);
                $api->write('=interval=0.3');
                $read = $api->read();
                $api->disconnect();
                foreach($read as $result){
                    if($result['packet-loss']>=1 || isset($result['status'])){
                        $disconnect++;
                    }else if($result['packet-loss']==0){
                        $connect++;
                    }
                }
                echo "<pre>";
                echo "Connect =".$connect." disconnect =".$disconnect;
                print_r($read);
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
        $id = $this->input->post('id');
        if($this->devices->delDevice($id)){
            if($this->devices->delInterfaces($id)){
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

    function getUnifiDevices(){
        $unifi_connection = new UniFi_API\Client('bibiehadikusuma@stiki.ac.id', '66027822bibiE', 'https://10.10.10.2:8443', 'default', '5.10.25');
        // $set_debug_mode   = $unifi_connection->set_debug(true);
        $loginresults     = $unifi_connection->login();
        $aps_array        = $unifi_connection->list_devices();       
        foreach($aps_array as $ap){
            if(isset($ap->name)){
                $_ap['id'] = $ap->device_id;
                $_ap['address'] = $ap->ip;
                $_ap['identity'] = $ap->name;
                $_ap['version'] = $ap->version;
                $_ap['model'] = $ap->model;
                $_ap['platform'] = 'UniFi';
                $_ap['mac'] = $ap->mac;
                if(isset($ap->uptime)){
                    $_ap['uptime'] = timespan($ap->uptime);    
                }else{
                    $_ap['uptime'] = null;    
                }
                if((isset($ap->rx_bytes) && isset($ap->tx_byte))){
                    $_ap['tx_bytes'] = $ap->tx_bytes;
                    $_ap['rx_bytes'] = $ap->rx_bytes;
                }else{
                    $_ap['tx_bytes'] = null;
                    $_ap['rx_bytes'] = null;
                }
                $_ap['aksi'] = "<a href='javascript:;' data-aksi='unifi' data-identity='".$_ap['identity']."' data-uptime='".$_ap['uptime']."' data-model='".$_ap['model']."' data-version='".$_ap['version']."' data-address='".$_ap['address']."' data-platform='".$_ap['platform']."' data-mac='".$_ap['mac']."' data-tx='".$_ap['tx_bytes']."' data-rx='".$_ap['rx_bytes']."' data-status='Connected'><i class='fa fa-plus'></i></a>";
            }
            $_aps_array[] = $_ap;
        }
        // echo "<pre>";
        // print_r($_aps_array);
        return $_aps_array;
    }
}

/* End of file Devices.php */
