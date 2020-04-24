<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Bandwidth_Model extends CI_Model {

    function get_data($interface){
        $this->db->where($interface);
        // $this->db->order_by('time', 'desc');
        // $this->db->limit(2000);
        // $this->db->limit(10);
        $data = $this->db->get('network_log');
        return $data->result();
    }

}

/* End of file ModelName.php */
