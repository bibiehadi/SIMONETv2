<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username')== null){
            redirect(site_url('login'),'refresh');
        }
        $this->load->model('bandwidth_model', 'bandwidth');
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
}

/* End of file Controllername.php */
