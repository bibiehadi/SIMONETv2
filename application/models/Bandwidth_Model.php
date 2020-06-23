<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Bandwidth_Model extends CI_Model {

    function getTrafficDashboard($interface){
        // $this->db->where('interface',$interface);
        // $this->db->order_by('id', 'desc');
        // $this->db->limit(10);
        // $this->db->order_by('time', 'asc');
        // // $this->db->limit(2000);
        // $data = $this->db->get('network_log');
        $data = $this->db->query( "select * from (select * from network_log where interface = '".$interface."'
        order by time DESC LIMIT 10 ) as ether order by id ASC "
        );
        return $data->result();
    }
    
    function get_data($interface){
        $this->db->where('interface',$interface['interface']);
        $this->db->where('time >=',$interface['first_date']);
        $this->db->where('time <=',$interface['last_date']);
        // $this->db->order_by('time', 'desc');
        // $this->db->limit(2000);
        // $this->db->limit(10);
        $data = $this->db->get('network_log');
        return $data->result();
    }

}

/* End of file ModelName.php */
