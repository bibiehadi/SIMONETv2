<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username')== null){
            redirect(site_url('login'),'refresh');
        }
        $this->load->model('Dashboard_Model', 'dashboard');
        
        $this->load->model('Bandwidth_Model', 'bandwidth');
        $this->load->model('Hotspot_Model', 'hotspot');
        $this->load->model('Devices_Model', 'devices');
        
        
    }
    
    public function index(){
        if($this->session->userdata('role')==='adm'){    
            $this->load->view('dashboard_view'); 
        }
    }

    function interface()
    {
        $ether = $this->input->post('iface');
        date_default_timezone_set('Asia/Jakarta');
        $graphs = $this->bandwidth->getTrafficDashboard($ether);
        $row = array (
            'tx' => array(), 
			'rx' => array(), 
			'point' => array() 
        );
        foreach($graphs as $graph){
            $row['tx'][] = round($graph->tx);
			$row['rx'][] = round($graph->rx);
            // $row['point'][] = date('H:i', strtotime($graph->time));
            $time = date('H:i', strtotime($graph->time));
			$row['point'][] = $time;
        }
        // $result = $row;
        // echo "<pre>";
        // print_r($graphs);
        // print_r($row);
        echo json_encode($row);
    }

    function total(){
        $data = array(
            'router' => count($this->devices->countDeviceByStatus(array('platform' => 'MikroTik', 'status' => 'Connected'))),
            'allrouter' => count($this->devices->countDeviceByStatus(array('platform' => 'MikroTik', 'status' => null))),
            'ap' => count($this->devices->countDeviceByStatus(array('platform' => 'UniFi', 'status' => 'Connected'))),
            'allap' => count($this->devices->countDeviceByStatus(array('platform' => 'UniFi', 'status' => null))),
            'connect' => count($this->countConnect()),
            'login' => count($this->countLogin())
        );
        echo json_encode(array("status" => TRUE, "data" => $data));
    }

    function countLogin(){
        // function untuk mengget semua data user active dari Mikrotik
        
        try{
            $api = $this->routerosapi;
            $user = $this->devices->getUserRouter(array('id' => '1111'));
            $api->port = $user['port'];
            if($api->connect("10.10.10.1",$user['username'],$user['password'])){
                $api->write('/ip/hotspot/active/print');
                $read = $api->read();
                $api->disconnect();
                return $read;       
            }
        }catch(Exeption $error){
            return $error;
        }
    }

    function countConnect(){
        // function untuk mengget semua data user active dari Mikrotik
        
        try{
            $api = $this->routerosapi;
            $user = $this->devices->getUserRouter(array('id' => '1111'));
            $api->port = $user['port'];
            if($api->connect("10.10.10.1",$user['username'],$user['password'])){
                $api->write('/ip/hotspot/host/print');
                $read = $api->read();
                $api->disconnect();
                return $read;       
            }
        }catch(Exeption $error){
            return $error;
        }
    }

    function getAdmins(){
        $data = $this->dashboard->getAdmins();
        foreach($data as $r){
            $r['aksi'] = "<a href='#tabAddAdmin' data-toggle='tab' data-aksi='editAdmin' data-id='".$r['id']."'><i class='fa fa-pencil-square-o'></i></a>
            <a href='javascript:;' data-toggle='tab' data-aksi='hapusAdmin' data-id='".$r['id']."' style='color : rgb(218,86,80)'><i class='fa fa-trash-o'></i></a>";
            $_data[] = $r;
        }
        echo "<pre>";
        print_r($_data);
        echo json_encode(array("status" => TRUE, "data" => $_data));
    }

    function getAdminByID(){
        $id = $this->input->post('id');
        $data = $this->dashboard->getAdminbyID($id);
        echo json_encode(array("status" => TRUE, "data" => $data));
    }

    function setAdmin(){
        // funtion untuk merubah data user profile di mikrotik
        $id = $this->input->post('idAdmin');
        if($this->input->post('passwordAdmin')!=''){
            $data = array(
                'username' => $this->input->post('userAdmin'),
                'password' => $this->input->post('passwordAdmin'),
                'email' => $this->input->post('emailAdmin'),
                'role' => $this->input->post('roleAdmin'),
            );
        }else{
            $data = array(
                'username' => $this->input->post('userAdmin'),
                'email' => $this->input->post('emailAdmin'),
                'role' => $this->input->post('roleAdmin'),
            );
        }
        if($this->dashboard->setAdmin($id,$data)){
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }

    function addAdmin(){
        // funtion untuk menambah data user profile di mikrotik 
        $data = array(
            'username' => $this->input->post('userAdmin'),
            'password' => $this->input->post('passwordAdmin'),
            'email' => $this->input->post('emailAdmin'),
            'role' => $this->input->post('roleAdmin')
        );
        if($this->dashboard->addAdmin($data)){
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
        
    }

    function delAdmin(){
        // funtion untuk menghapust user profile di mikrotik dan database
        $id = $this->input->post('id');
        if($this->dashboard->delAdmin($id)){
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }

    function getDeviceAuth(){
        $data = $this->dashboard->getDeviceAuth();
        foreach($data as $r){
            $r['aksi'] = "<a href='javascript:;' data-aksi='editAuth' data-id='".$r['id']."'><i class='fa fa-pencil-square-o'></i></a>
            <a href='javascript:;' data-aksi='hapusAuth' data-id='".$r['id']."' style='color : rgb(218,86,80)'><i class='fa fa-trash-o'></i></a>";
            $_data[] = $r;
        }
        echo json_encode(array("status" => TRUE, "data" => $_data));
    }

    function getTemplateConfig(){
        $data = $this->dashboard->getTemplateConfig();
        foreach($data as $r){
            $r['aksi'] = "<a href='javascript:;' data-aksi='editConfig' data-id='".$r['id']."'><i class='fa fa-pencil-square-o'></i></a>
            <a href='javascript:;' data-aksi='hapusConfig' data-id='".$r['id']."' style='color : rgb(218,86,80)'><i class='fa fa-trash-o'></i></a>";
            $_data[] = $r;
        }
        echo json_encode(array("status" => TRUE, "data" => $_data));
    }
    
}

/* End of file Controllername.php */
