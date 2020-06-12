<?php

defined('BASEPATH') OR exit('No direct script access allowed');

set_include_path(get_include_path() . PATH_SEPARATOR . APPPATH . 'third_party/phpseclib');
include(APPPATH . '/third_party/phpseclib/Net/SSH2.php');

require_once('application/libraries/Client.php');
require_once('application/libraries/ZukoLibs.php');
class Devices extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username')=== null){
            redirect('login');
        }
        $this->load->model('devices_model','devices');
        $this->load->model('mikrotik_model','mikrotik');
    }
    

    public function index()
    {
        // $data['discovery'] = $this->discoveryDevices();
        // $data['unifiDevices'] = $this->getUnifiDevices();
        $data['location'] = $this->getLocation();
        $this->load->view('devices_view',$data);
        
    }

    public function detailDevice()
    {
        // function untuk menampilkan halaman detail user hotspot 
        $id = $this->input->post('id');
        $data = $this->devices->getDevice(array('id'=> $id));
        $data['location'] = $this->getLocation();
        $data['list_devices'] = $this->devices->getdevices();
        $data['last_ros'] = $this->devices->getLastesROS();
        $data['subdevices'] = $this->devices->getdevicesbymaster(array('id_device' => $id));
        if($data['status'] == 'Connected' && $data['platform']=="MikroTik"){
            $this->syncIdentities($data['address'],$id);
        }
        // echo "<pre>";
        // print_r($data['list_devices']);
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
            'address' => $this->input->post('address4'),
            'platform' => $this->input->post('platform'),
            'id_location' => $this->input->post('location')
        );
        $this->devices->addDevice($data);
        echo json_encode(array("status" => TRUE));
    }

    function addDeviceByDiscovery(){
        $data = array(
            'address' => $this->input->post('address'),
            'mac_address' => $this->input->post('mac_address'),
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
            $api->port=$user['port'];
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
                    if(isset($r['address']) && ($r['platform']=='MikroTik')){
                        if(!in_array($r['address'], $ip)){
                            $r['id'] = $r['.id'];
                            $version = explode('.',$r['version']);
                            if($version[0] == '1'){
                                $r['platform'] = "MikroTik Switch";
                            }
                            $r['aksi'] = "<a href='javascript:;' data-aksi='discovery' data-identity='".$r['identity']."' data-uptime='".$r['uptime']."' data-board='".$r['board']."' data-version='".$r['version']."' data-address='".$r['address']."' data-mac_address='".$r['mac-address']."' data-platform='".$r['platform']."' data-status='Connected'><i class='fa fa-plus'></i></a>";
                            $_data[] = $r;
                        }
                    } 
                }    
                // return $_data;
                
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "data" => $_data,
                    );
                echo json_encode($output);            
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE));
        }
    }

    function setDevice(){
        // function untuk merubah data user hotspot dan menyimpannya ke mikrotik
        $device = $this->devices->getDevice(array('id' => $this->input->post('id')));
        if($device['platform'] == 'MikroTik'){
            $user = $this->devices->getUserRouter(array('id' => '2222'));
            $data = array(
                'id' => $this->input->post('id'),
                'identity' => $this->input->post('identity'),
                'serial_number' => $this->input->post('serial'),
                'address' => $this->input->post('address'),
                'id_device' => $this->input->post('masterdevice'),
                'id_location' => $this->input->post('location')  
            );
            if($data['identity'] != $device['identity']){
                try{
                    $api = $this->routerosapi;
                    $api->port = 8728;
                    if($api->connect($data['address'],$user['username'],$user['password'])){
                        $api->write('/system/identity/set',false);
                        $api->write('=name='.$data['identity']);
                        $write = $api->read();
                        $api->disconnect();
                        $this->session->set_flashdata('detail_device', '<div class="alert alert-dismissable alert-success">
                            <i class="ti ti-check"></i>&nbsp; <strong>Well Done!</strong> Data Device '.$device['identity'].' Berhasil Dirubah
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>');
                        echo json_encode(array("status" => TRUE, "identity" => $write));
                    }else{
                        echo json_encode(array("status" => FALSE, "data" => $device));
                    }    
                }catch(exeption $e){
                    echo $e;
                }
            }
            echo json_encode(array("status" => TRUE));
            $this->devices->setDevice($data);
        }elseif($this->input->post('identity') == null){
            $data = array(
                'id' => $this->input->post('id'),
                'serial_number' => $this->input->post('serial'),
                'address' => $this->input->post('address'),
                'id_device' => $this->input->post('masterdevice'),
                'id_location' => $this->input->post('location')  
            );
            $this->devices->setDevice($data);
            $this->session->set_flashdata('detail_device', '<div class="alert alert-dismissable alert-success">
                <i class="ti ti-check"></i>&nbsp; <strong>Well Done!</strong> Data Device '.$device['identity'].' Berhasil Dirubah
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>');
        
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => False));
            $this->session->set_flashdata('detail_device', '<div class="alert alert-dismissable alert-danger">
                <i class="ti ti-check"></i>&nbsp; <strong>Well Done!</strong> Data Device '.$device['identity'].' Gagal Dirubah
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>');
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
                // echo json_encode(array("status" => FALSE, "msg" => 'Gagal terhubung ke Router'.$device['address']));
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

    function cekOSUpdate(){
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect('10.10.10.32',$user['username'],$user['password'])){
                $comm = $api->comm('/system/package/update/');
                // $read = $api->read();
                // $api->disconnect();
                // return $read[0]['name'];
                print_r($comm);
            }
        }catch(Exeption $error){
            // return 'error';
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

    function getInterfacesJSON($id){
        // $id = $this->input->post('id');
        // function untuk mengget semua data user hotspot dari database
        $data = $this->devices->getinterfaces(array('id_device' => $id));
        $_data = array();
        foreach($data as $r){
            $r['tx_byte'] = byte_format($r['tx_byte']); 
            $r['rx_byte'] = byte_format($r['rx_byte']); 
            // $r['aksi'] = "<a href='javascript:;' data-aksi='hapus' data-id='".$r['id']."' style='color : rgb(218,86,80)'><i class='fa fa-trash-o'></i></a>";
            $_data[] = $r;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $_data,
        );
        echo json_encode($output);
    }

    function getInterfacesAPI(){
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
                    if(in_array($result['mac-address'], $mac)){
                        $same++;
                        $result['mac-address'] = $result['mac-address'].':0'.$same;
                    
                    }else{
                        $mac[] = $result['mac-address'];
                    }
                    $_read[]=$result;
                }
                $this->devices->syncinterfaces($_read,$id);
                echo json_encode(array("status" => TRUE, "data" => $_read));
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
        $identity = $this->input->post('identity');
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->comm('/system/reboot');
                $api->disconnect();
                $this->devices->updateStatus($ip,array('status' => 'Reboot'));
                $this->session->set_flashdata('devices', '<div class="alert alert-dismissable alert-success">
                <i class="ti ti-check"></i>&nbsp; <strong>Well Done!</strong> Reboot Device '.$identity.' Berhasil!!
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>');
        
                echo json_encode(array("status" => TRUE));
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE));
        }
    }

    function delDevice(){
        // funtion menghapus data user hotspot di mikrotik dan database
        $id = $this->input->post('id');
        $identity = $this->input->post('identity');
        if($this->devices->delDevice($id)){
            if($this->devices->delInterfaces($id)){
                $this->session->set_flashdata('devices', '<div class="alert alert-dismissable alert-success">
                <i class="ti ti-check"></i>&nbsp; <strong>Well Done!</strong> Menghapus Device '.$identity.' Berhasil !!
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>');
                echo json_encode(array("status" => TRUE));
            }
        }else{
            echo json_encode(array("status" => FALSE));
        }
        
    }

    function cekMikroTik(){
        // $ip = $this->input->post('ip');
        $ip = '10.10.10.135';
        $mac = '00:0C:42:E5:0D:C6';
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->write('/ip/address/print');
                $read = $api->read();
                $api->disconnect();
                echo json_encode(array("status" => TRUE));
            }elseif($api->connect($mac,$user['username'],$user['password'])){
                echo "gae MAC";
                $api->disconnect();
            }else{
                echo "gak kenek";
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE));
        }
    }

    function downloadMikroTikOS(){
        $ip = $this->input->post('ip');
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = $user['port'];
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->write('/system/package/update/download');
                $read = $api->read();
                foreach($read as $r){
                    if(isset($r['status'])){
                        $api->disconnect();
                        $status = $r['status'];
                    }else{
                        $api->disconnect();
                        $status = $r[0]['message'];
                        echo json_encode(array("status" => TRUE, "message" => $status));
                        die();
                    }
                }
                echo json_encode(array("status" => TRUE, "message" => $status));
                die();
                $api->disconnect();
            }else{
                echo json_encode(array("status" => FALSE, "message" => "gagal terhubung ke router"));
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE));
        }
    }

    function getUnifiDevices(){
        $user = $this->devices->getUserRouter(array('id' => '3333'));
        $unifi_connection = new UniFi_API\Client($user['username'], $user['password'], 'https://10.10.10.2:8443', 'default', '5.10.25');
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
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $_aps_array,
            );
        echo json_encode($output);            
    }

    function getLocation(){
        $zuko = new ZukoLibs;

        $output = $zuko->connect();
        $token = $output['data']['session_token'];

        $par = array(
            'filter' => array(),
            'limit' => 150,
            'offset' => 0,
        );

        $location = $zuko->get_ruang($token,$par);
        return $location;

    }
}

/* End of file Devices.php */
