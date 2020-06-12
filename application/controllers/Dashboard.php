<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username')== null){
            redirect(site_url('login'),'refresh');
        }
            
    }
    
    public function index(){
        if($this->session->userdata('role')==='adm'){    
            $this->load->view('dashboard_view'); 
        }
    }
}

/* End of file Controllername.php */
