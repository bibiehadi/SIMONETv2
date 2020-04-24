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

    public function lineGraph($interface)
    {
        $graphs = $this->bandwidth->get_data(array('interface' => $interface));
        // echo '<pre>';
        // print_r($graph);
        foreach($graphs as $graph){
            // $row['date'][] = $this->formatDate($graph['time']);
            $row['date'][] = $graph->time;
            $row['tx'][] = $graph->tx;
            $row['rx'][] = $graph->rx;
            
        }
        $result = $row;
        // echo "<pre>";
        // print_r($result);
        echo json_encode($result);
    }

    function formatDate($date){
        $data = str_replace('-',',',$date);
        $data = str_replace(':',',',$data);
        $result = str_replace(' ',',',$data);
        return $result;
    }

}

/* End of file Controllername.php */
