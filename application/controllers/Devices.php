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
        $data['location'] = $this->devices->getLocation();
        $this->load->view('devices_view',$data);
        
    }

    public function detailDevice()
    {
        // function untuk menampilkan halaman detail user hotspot 
        $serial = $this->input->post('serial');
        $data = $this->devices->getDevice(array('serial_number'=> $serial));
        if($data['status'] == 'Connected'){
            $this->syncIdentities($data['main_address4'],$serial);
        }
        // print_r($data);
        $this->load->view('device_detail_view',$data);
        
    }

    function devicesJSON(){
        // funtion untuk mengget semua data user profile dari database
        $data = $this->devices->getdevices();
        $_data = array();
            foreach($data as $r){
                $r['aksi'] = "<a href='javascript:;' data-aksi='edit' data-serial='".$r['serial_number']."'><i class='fa fa-pencil-square-o'></i></a>
                <a href='javascript:;' data-aksi='hapus' data-serial='".$r['serial_number']."' style='color : rgb(218,86,80)'><i class='fa fa-trash-o'></i></a>";
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

    function syncIdentities($ip,$serial){
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
                $identity['serial_number'] = $serial;
                if($identity['identity']!='error'){
                    $this->devices->syncdatadevice($identity,$read);
                }
                echo json_encode(array("status" => TRUE));
            }else{
                echo json_encode(array("status" => FALSE, "msg" => 'Gagal terhubung ke Router'.$device['main_address4']));
            }
        }catch(Exeption $error){
            echo json_encode(array("status" => FALSE, "msg" => $error));
        }
    }

    function cek(){
        // funtion untuk menyimpan data user hotspot ke mikrotik
        $data = $this->devices->getdevices();
        try{
            foreach($data as $device){
                $connect = 0; $disconnect =0;
                $api = $this->routerosapi;
                if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                    $api->write('/ping',false);
                    $api->write('=address='.$device['main_address4'],false);
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
            }
        }catch(exeption $e){
            echo $e;
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

    function getInterfaces($ip,$serial){
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->write('/interface/print');
                $read = $api->read();
                $api->disconnect();
                $mac='';
                $same = 0;
                foreach($read as $result){
                    $_mac = $result['mac-address'];
                    if($result['mac-address']==$mac){
                        $same++;
                        $result['mac-address'] = $result['mac-address'].':0'.$same;
                    }
                    $mac = $_mac;
                    $_read[]=$result;
                }
                $this->devices->syncinterfaces($_read,$serial);
            }
        }catch(Exeption $error){
            return 'error';
        }
    }

    function getIP($ip){
        $user = $this->devices->getUserRouter(array('id' => '2222'));
        try{
            $api = $this->routerosapi;
            $api->port = 8728;
            if($api->connect($ip,$user['username'],$user['password'])){
                $api->write('/ip/address/print');
                // $api->write('?interface=ether1');
                // $api->write('print');
                $read = $api->read();
                $api->disconnect();
                print_r($read);
            }
        }catch(Exeption $error){
            return 'error';
        }
    }

}

/* End of file Devices.php */
