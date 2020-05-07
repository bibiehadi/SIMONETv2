<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hotspot extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')=== null){
            redirect('login');
        }
        $this->load->model('hotspot_model','hotspot');
        $this->load->model('mikrotik_model','mikrotik');
    }
    

    public function index()
    {
        
    }

    public function userHotspot(){
        $data['profile'] = $data = $this->hotspot->getuserprofile();
        $this->load->view('user_hotspot_view',$data);
    }

    function userHotspotJSON(){
        $data = $this->hotspot->getuserhotspot();
        foreach($data as $r){
            $r['password'] = '************************';
            $r['bytes_in'] = $this->formatBytes2($r['bytes_in']); 
            $r['bytes_out'] = $this->formatBytes2($r['bytes_out']); 
            $r['aksi'] = "<a href='javascript:;' data-aksi='hapus' data-id='".$r['id']."'><i class='fa fa-trash-o'></i></a>";
            $_data[] = $r;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $_data,
        );
        echo json_encode($output);
    }

    function delUserHotspot(){
        $id = $this->input->post('id');
        try{
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ip/hotspot/user/remove',false);
			    $api->write('=.id='.$id);
                $write = $api->read();
                $api->disconnect();
                $this->hotspot->deluserhotspot($id);
                echo json_encode(array("status" => TRUE));
            }else{
                echo json_encode(array("status" => FALSE));
            }
        }catch(exeption $e){
            echo $e;
        }
    }

    function syncUserHotspot(){
        try{
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ip/hotspot/user/print');
                $read = $api->read();
                $api->disconnect();        
                $this->hotspot->syncUserHotspot($read);  
                echo json_encode(array("status" => TRUE));
            }else{
                echo json_encode(array("status" => FALSE));
            }
        }catch(Exeption $error){
            return $error;
        }
    }

    public function userProfile(){
        $this->load->view('user_profile_view');
    }

    function userProfileJSON(){
        $data = $this->hotspot->getuserprofile();
        $_data = array();
            foreach($data as $r){
                $r['aksi'] = "<a href='javascript:;' data-aksi='edit' data-id='".$r['id']."'><i class='fa fa-pencil-square-o'></i></a>
                <a href='javascript:;' data-aksi='hapus' data-id='".$r['id']."'><i class='fa fa-trash-o'></i></a>";
                $_data[] = $r;
            }
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $_data,
        );
        echo json_encode($output);
    }

    function getUserProfileByID(){
        $id = $this->input->post('id');
        $data = $this->hotspot->getuserprofilebyid(array('id'=> $id));
        if($data){
            echo json_encode($data);
        }
    }

    function setUserProfile(){
        $data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'session_timeout' => $this->input->post('session'),
            'status_autorefresh' => $this->input->post('status'),
            'shared_users' => $this->input->post('shared'),
            'add_mac_cookie' => $this->input->post('cookie'),
            'rate_limit' => $this->input->post('limit')
        );
        try{
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ip/hotspot/user/profile/set',false);
			    $api->write('=.id='.$data['id'],false);
			    $api->write('=name='.$data['name'], false );
			    $api->write('=session-timeout='.$data['session_timeout'], false );
			    $api->write('=status-autorefresh='.$data['status_autorefresh'], false );
			    $api->write('=shared-users='.$data['shared_users'], false );
			    $api->write('=add-mac-cookie='.$data['add_mac_cookie'], false );
			    $api->write('=rate-limit='.$data['rate_limit']);
                $write = $api->read();
                $api->disconnect();
                echo json_encode(array("status" => TRUE));
            }else{
                echo json_encode(array("status" => FALSE));
            }
        }catch(exeption $e){
            echo $e;
        }
    }

    function addUserProfile(){
        $data = array(
            'name' => $this->input->post('name'),
            'session_timeout' => $this->input->post('session'),
            'status_autorefresh' => $this->input->post('status'),
            'shared_users' => $this->input->post('shared'),
            'add_mac_cookie' => $this->input->post('cookie'),
            'rate_limit' => $this->input->post('limit')
        );
        try{
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ip/hotspot/user/profile/add',false);
			    $api->write('=name='.$data['name'], false );
			    $api->write('=session-timeout='.$data['session_timeout'], false );
			    $api->write('=status-autorefresh='.$data['status_autorefresh'], false );
			    $api->write('=shared-users='.$data['shared_users'], false );
			    $api->write('=add-mac-cookie='.$data['add_mac_cookie'], false );
			    $api->write('=rate-limit='.$data['rate_limit']);
                $write = $api->read();
                $api->disconnect();
                echo json_encode(array("status" => TRUE, "data" => $data));
            }else{
                echo json_encode(array("status" => FALSE));
            }
        }catch(exeption $e){
            echo $e;
        }
    }

    function delUserProfile(){
        $id = $this->input->post('id');
        try{
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ip/hotspot/user/profile/remove',false);
			    $api->write('=.id='.$id);
                $write = $api->read();
                $api->disconnect();
                $this->hotspot->deluserprofile($id);
                echo json_encode(array("status" => TRUE));
            }else{
                echo json_encode(array("status" => FALSE));
            }
        }catch(exeption $e){
            echo $e;
        }
    }

    function syncUserProfile(){
        try{
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ip/hotspot/user/profile/print');
                $read = $api->read();
                $api->disconnect();
                $this->hotspot->syncUserProfile($read); 
                echo json_encode(array("status" => TRUE));
            }else{
                echo json_encode(array("status" => FALSE));
            }
        }catch(Exeption $error){
            return $error;
        }
    }

    public function userActive(){
        $this->load->view('user_aktif_view');
    }

    function userActiveJSON(){
        try{
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ip/hotspot/active/print');
                $read = $api->read();
                $api->disconnect();        
            }
            $_read = array();
            foreach($read as $r){
                $r['id'] = $r['.id'];
                $r['aksi'] = "<a href='javascript:;' data-aksi='hapus' data-id='".$r['id']."'><i class='fa fa-trash-o'></i></a>";
                $_read[] = $r;
            }
            $output = array(
                // "draw" => $this->input->post('draw'),
                "data" => $_read,
            );
            echo json_encode($output);       
        }catch(Exeption $error){
            return $error;
        }
    }

    function delUserActive(){
        $id = $this->input->post('id');
        try{
            $api = $this->routerosapi;
            if($api->connect("192.168.10.1","api","stikimonitor","62148")){
                $api->write('/ip/hotspot/active/remove',false);
			    $api->write('=.id='.$id);
                $write = $api->read();
                $api->disconnect();
                echo json_encode(array("status" => TRUE));
            }else{
                echo json_encode(array("status" => TRUE));
            }
        }catch(exeption $e){
            echo $e;
        }
    }

    function formatBites($size, $decimals = 0){
        $unit = array(
        '0' => 'bps',
        '1' => 'kbps',
        '2' => 'Mbps',
        '3' => 'Gbps',
        '4' => 'Tbps',
        '5' => 'Pbps',
        '6' => 'Ebps',
        '7' => 'Zbps',
        '8' => 'Ybps'
        );
        
        for($i = 0; $size >= 1000 && $i <= count($unit); $i++){
        $size = $size/1000;
        }
        
        return round($size, $decimals).' '.$unit[$i];
    }

    function formatBytes2($size, $decimals = 0){
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

/* End of file Hotspot.php */
