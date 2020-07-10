<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Statistic_Model','statistic');
    }

    public function index(){
        $this->load->view('statistic_view');
        // $this->load->view('graph_view');
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
        // echo '<pre>';
        // print_r($graph);
        $row = array (
            'tx' => array(), 
			'rx' => array()
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

    public function lineGraphResource()
    {
        date_default_timezone_set('Asia/Jakarta');
        $first_date = "2020-07-08 00:00:00";
        $last_date = date("Y-m-d H:i:s");
        $first_date = $this->input->post('start');
        $last_date = $this->input->post('end');
        $graphs = $this->statistic->getDataResource(array('first_date' => $first_date, 'last_date' => $last_date));
        // echo '<pre>';
        // print_r($graph);
        $row = array (
            'cpu' => array(), 
			'memory' => array(), 
			'point' => array() 
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
}

/* End of file Statistic.php */
