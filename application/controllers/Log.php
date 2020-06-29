<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_Model', 'log_event');
    }
    

    function logEventJSON(){
        // function untuk mengget semua data user hotspot dari database
        $data = $this->log_event->getLog();
        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $data,
        );
        echo json_encode($output);
    }

}

/* End of file Log.php */
