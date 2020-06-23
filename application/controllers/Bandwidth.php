<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bandwidth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('bandwidth_model','bandwidth');
    }

    public function index(){
        $this->load->view('graph_view');
    }

    public function lineGraph()
    {
        // echo 'Default Timezone: ' . date('d-m-Y H:i:s') . '</br>';
        date_default_timezone_set('Asia/Jakarta');
        // echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');
        $interface = "BPro100";
        $first_date = "2020-06-20";
        $last_date = date("Y-m-d H:i:s");
        $graphs = $this->bandwidth->get_data(array('interface' => $interface, 'first_date' => $first_date, 'last_date' => $last_date));
        // echo '<pre>';
        // print_r($graph);
        $row = array (
            'tx' => array(), 
			'rx' => array(), 
			'point' => array() 
        );
        foreach($graphs as $graph){
            $row['tx'][] = round($graph->tx);
			$row['rx'][] = round($graph->rx);
            // $row['point'][] = date('H:i:s', strtotime($graph->time));
            $time = date('Y-m-d H:i:s', strtotime($graph->time));
			$row['point'][] = $time;
        }
        // $result = $row;
        // echo "<pre>";
        // echo $last_date;
        // print_r($row);
        echo json_encode($row);
    }

    function formatDate($date){
        $data = str_replace('-',',',$date);
        $data = str_replace(':',',',$data);
        $result = str_replace(' ',',',$data);
        return $result;
    }

}

/* End of file Controllername.php */
