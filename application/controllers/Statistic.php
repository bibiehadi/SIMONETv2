<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('application/libraries/Client.php');
class Statistic extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username')== null){
            redirect(site_url('login'),'refresh');
        }
        $this->load->model('Statistic_Model','statistic');
        $this->load->model('Devices_Model','devices');
        $this->load->model('Hotspot_Model','hotspot');
    }

    public function index(){
        // $this->load->view('statistic_view');
    }

    public function resource(){
        $this->load->view('statistic_resource_view');
    }

    public function bandwidth(){
        $this->load->view('statistic_bandwidth_view');
    }

    public function ping(){
        $this->load->view('statistic_ping_view');
    }

    public function hotspot(){
        // $data['userCount'] = $this->getUserCount();
        $this->load->view('statistic_hotspot_view');
    }

    public function lineGraphInterface()
    {
        // echo 'Default Timezone: ' . date('d-m-Y H:i:s') . '</br>';
        date_default_timezone_set('Asia/Jakarta');
        // echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');
        $interface = $this->input->post('iface');
        $first_date = $this->input->post('start');
        $last_date = $this->input->post('end');
        $graphs = $this->statistic->getDataInterface(array('interface' => $interface, 'first_date' => $first_date, 'last_date' => $last_date));
        $stat = $this->statistic->getStatisticInterface(array('interface'=> $interface ,'first_date' => $first_date, 'last_date' => $last_date));
        // echo '<pre>';
        // print_r($graph);
        $row = array (
            'tx' => array(), 
            'rx' => array(),
            'stat' => $stat
        );
        foreach($graphs as $graph){
            $row['tx'][] = [strtotime($graph->time)*1000,round($graph->tx)];
			$row['rx'][] = [strtotime($graph->time)*1000,round($graph->rx)];
            // $row['point'][] = date('H:i:s', strtotime($graph->time));
            // if(date('H:i:s', strtotime($graph->time))=='00:00:00'){
                // $time = date('Y-m-d H:i:s', strtotime($graph->time));
            // }else{
                // $time = date('H:i:s', strtotime($graph->time));
            // }
			// $row['point'][] = $time;
        }
        // $result = $row;
        // echo "<pre>";
        // echo $last_date;
        // print_r($time = date('H:i:s', strtotime($first_date)));
        echo json_encode($row);
    }

    public function linePingQuality()
    {
        date_default_timezone_set('Asia/Jakarta');
        $interface = $this->input->post('iface');
        $first_date = $this->input->post('start');
        $last_date = $this->input->post('end');
        $graphs = $this->statistic->getQuality(array('interface' => $interface, 'first_date' => $first_date, 'last_date' => $last_date));
        $stat = $this->statistic->getStatisticQuality(array('interface'=> $interface ,'first_date' => $first_date, 'last_date' => $last_date));
        // echo '<pre>';
        // print_r($graph);
        $row = array (
            'ping' => array(), 
            'quality' => array(), 
            'stat' => $stat
        );
        foreach($graphs as $graph){
            $row['ping'][] = [strtotime($graph->time)*1000,$graph->ping_avg*1];
            $row['quality'][] = [strtotime($graph->time)*1000,$graph->loss];
            // $row['jitter'][] = $graph->jitter;
            // if(date('H:i:s', strtotime($graph->time))=='00:00:00'){
                // $time = date('Y-m-d H:i:s', strtotime($graph->time));
            // }else{
                // $time = date('H:i:s', strtotime($graph->time));
            // }
			// $row['point'][] = $time;
        }
        // $result = $row;
        // echo "<pre>";
        // echo $last_date;
        // print_r($time = date('H:i:s', strtotime($first_date)));
        echo json_encode($row);
    }

    public function lineGraphResource()
    {
        date_default_timezone_set('Asia/Jakarta');
        $last_date = date("Y-m-d H:i:s");
        $first_date = $this->input->post('start');
        $last_date = $this->input->post('end');
        $graphs = $this->statistic->getDataResource(array('first_date' => $first_date, 'last_date' => $last_date));
        $stat = $this->statistic->getStatisticResource(array('first_date' => $first_date, 'last_date' => $last_date));
        
        // echo '<pre>';
        // print_r($graph);
        $row = array (
            'cpu' => array(), 
			'memory' => array(), 
            'point' => array(),
            'stat' => $stat
        );
        foreach($graphs as $graph){
            $time = date('Y-m-d H:i:s', strtotime($graph->time));
            $row['cpu'][] = [strtotime($graph->time)*1000,round($graph->cpu,2)];
			$row['memory'][] = [strtotime($graph->time)*1000,round(($graph->memory/8455716864)*100,2)];
            // $row['point'][] = date('H:i:s', strtotime($graph->time));
            // if(date('H:i:s', strtotime($graph->time))=='00:00:00'){
            
            // }else{
                // $time = date('H:i:s', strtotime($graph->time));
            // }
			$row['point'][] = $time;
        }
        // $result = $row;
        // echo "<pre>";
        // echo $last_date;
        // print_r($time = date('H:i:s', strtotime($first_date)));
        echo json_encode($row);
    }

    function getStatistic(){
        print_r($this->statistic->getStatisticInterface(array('interface'=>'Indosat' ,'first_date' => '2020-07-12', 'last_date' => '2020-07-13')));
        print_r($this->statistic->getStatisticResource(array('first_date' => '2020-07-12', 'last_date' => '2020-07-13')));

    }

    function getUserCountAPJSON(){
        $user = $this->devices->getUserRouter(array('id' => '3333'));
        $unifi_connection = new UniFi_API\Client($user['username'], $user['password'], 'https://10.10.10.115:8443', 'default', '5.10.25');
        // $set_debug_mode   = $unifi_connection->set_debug(true);
        $loginresults     = $unifi_connection->login();
        $aps_array        = $unifi_connection->list_devices();

/**
 * output the results in HTML format
 */     $user_tot = 0;
        header('Content-Type: text/html; charset=utf-8');
        foreach ($aps_array as $ap) {
            if ($ap->type === 'uap') {
                $aps['name'] = $ap->name;
                $aps['y'] = $ap->num_sta;
                $user_tot += $ap->num_sta;
                if($ap->num_sta > 3){
                    $stat_ap[] =$aps;
                }
                // echo '<b>AP name:</b>' . $ap->name . ' <b>model:</b>' . $ap->model . ' <b># connected clients:</b>' . $ap->num_sta . '<br>';
            }
        }
        // return $stat_ap;
        // echo "<pre>";
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $stat_ap,
            "total" => $user_tot
        );
        echo json_encode($output);

        // echo json_encode($stat_ap);    
        // krsort($stat_ap[]['y']);
        // echo "<pre>";
        // print_r($stat_ap);
        // echo json_encode($user_tot);
    }

    function getUserCount(){
        // function untuk menghitung user yang terhubung ke jaringan
        try{
            $api = $this->routerosapi;
            $user = $this->devices->getUserRouter(array('id' => '1111'));
            $api->port = $user['port'];
            if($api->connect("10.10.10.1",$user['username'],$user['password'])){
                $api->write('/ip/hotspot/host/print');
                $read = $api->read();
                $api->disconnect();      
                return count($read);       
            }
        }catch(Exeption $error){
            return $error;
        }
    }

    function getUserCountWLAN(){
        $user = $this->devices->getUserRouter(array('id' => '3333'));
        $unifi_connection = new UniFi_API\Client($user['username'], $user['password'], 'https://10.10.10.115:8443', 'default', '5.10.25');
        // $set_debug_mode   = $unifi_connection->set_debug(true);
        $loginresults     = $unifi_connection->login();
        $aps_array        = $unifi_connection->list_devices();

        /**
         * output the results in HTML format
         */     
        $user_tot = 0;
        // header('Content-Type: text/html; charset=utf-8');
        foreach ($aps_array as $ap) {
            if ($ap->type === 'uap') {
                $user_tot += $ap->num_sta;
            }
        }
        return $user_tot;
    }

    function getUserCountJSON(){
        $wlan = $this->getUserCountWLAN();
        $lan = $this->getUserCount()-$wlan;
        $tot[0] = array('name' => 'LAN', 'y' => $lan);
        $tot[1] = array('name' => 'WLAN', 'y' => $wlan);
        echo json_encode(array('data' => $tot, 'total' => $wlan + $lan));
    }

    function getUserCountSSIDJSON(){
        $user = $this->devices->getUserRouter(array('id' => '3333'));
        $unifi_connection = new UniFi_API\Client($user['username'], $user['password'], 'https://10.10.10.115:8443', 'default', '5.10.25');
        // $set_debug_mode   = $unifi_connection->set_debug(true);
        $loginresults     = $unifi_connection->login();
        $aps_array        = $unifi_connection->list_clients();

        /**
         * output the results in HTML format
         */     
        $staf_tot = 0;
        $stiki_tot = 0;
        $other = 0;
        $tot = 0;
        //         header('Content-Type: text/html; charset=utf-8');
        foreach ($aps_array as $ap) {
            if (isset($ap->essid)) {
                if($ap->essid == 'staf@STIKI.wifi'){
                    $staf_tot ++;
                }elseif($ap->essid == '@STIKI.wifi'){
                    $stiki_tot++;
                }else{
                    $other++;
                }
            }
        }
        // return $stat_ap;
        // echo "<pre>";
        $ssid[0] = array('name' => 'staf@STIKI.wifi', 'y' => $staf_tot);
        $ssid[1] = array('name' => '@STIKI.wifi', 'y' => $stiki_tot);
        $ssid[2] = array('name' => 'other', 'y' => $other);
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $ssid,
            "total" => $staf_tot + $stiki_tot + $other
        );
        echo json_encode($output);    
        // krsort($ssid);
        // echo json_encode($ssid);    
    }

    function getUserCountRadioJSON(){
        $user = $this->devices->getUserRouter(array('id' => '3333'));
        $unifi_connection = new UniFi_API\Client($user['username'], $user['password'], 'https://10.10.10.115:8443', 'default', '5.10.25');
        // $set_debug_mode   = $unifi_connection->set_debug(true);
        $loginresults     = $unifi_connection->login();
        $aps_array        = $unifi_connection->list_clients();

        /**
         * output the results in HTML format
         */     
        $na = 0;
        $ng = 0;
        $tot = 0;
        //         header('Content-Type: text/html; charset=utf-8');
        foreach ($aps_array as $ap) {
            if (isset($ap->radio)) {
                if($ap->radio == 'na'){
                    $na++;
                }elseif($ap->radio == 'ng'){
                    $ng++;
                }
            }
        }
        $radio[0] = array('name' => '5ghz', 'y' => $na);
        $radio[1] = array('name' => '2.4ghz', 'y' => $ng);
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $radio,
            "total" => $na + $ng
        );
        echo json_encode($output);
        // print_r($aps_array);
    }

    function getMostActiveClient(){
        $clients = $this->hotspot->getMostActiveClient();
        foreach($clients as $clie){
            $clie['bytes_in'] = byte_format($clie['bytes_in']);
            $clie['bytes_out'] = byte_format($clie['bytes_out']);
            $client[] = $clie;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $client
        );
        echo json_encode($output);   
    }

    function getMostActiveProfile(){
        $profiles = $this->hotspot->getMostActiveProfile();
        foreach($profiles as $pro){
            $pro['download'] = byte_format($pro['download']);
            $pro['upload'] = byte_format($pro['upload']);
            $profile[] = $pro;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $profile
        );
        echo json_encode($output);
    }
    
}

/* End of file Statistic.php */
