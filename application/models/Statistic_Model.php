<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic_Model extends CI_Model {

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
    
    function getDataInterface($interface){
        $this->db->where('interface',$interface['interface']);
        $this->db->where('time >=',$interface['first_date']);
        $this->db->where('time <=',$interface['last_date']);
        $data = $this->db->get('network_log');
        return $data->result();
    }

    function getStatisticInterface($interface){
        $this->db->select('max(tx) as MaxTx, min(tx) as MinTx, avg(tx) as AvgTx, max(rx) as MaxRx, min(rx) as MinRx, avg(rx) as AvgRx');
        $this->db->where('interface',$interface['interface']);
        $this->db->where('time >=',$interface['first_date']);
        $this->db->where('time <=',$interface['last_date']);
        $data = $this->db->get('network_log');
        return $data->row_array();
    }

    function getDataResource($interface){
        $this->db->where('time >=',$interface['first_date']);
        $this->db->where('time <=',$interface['last_date']);
        // $this->db->order_by('time', 'desc');
        // $this->db->limit(2000);
        // $this->db->limit(10);
        $data = $this->db->get('resource_log');
        return $data->result();
    }

    function getStatisticResource($interface){
        $this->db->select('max(cpu) as MaxCPU, min(cpu) as MinCPU, avg(cpu) as AvgCPU, max(memory) as MaxMemory, min(memory) as MinMemory, avg(memory) as AvgMemory');
        $this->db->where('time >=',$interface['first_date']);
        $this->db->where('time <=',$interface['last_date']);
        // $this->db->order_by('time', 'desc');
        // $this->db->limit(2000);
        // $this->db->limit(10);
        $data = $this->db->get('resource_log');
        return $data->row_array();
    }

    function getDataInterfacePerHour($interface){
        $query = $this->db->query("select hour(time) as time, SUM(tx) as tx, SUM(rx) as rx
            from network_log where interface = '".$interface['interface']."'
            and time >= '".$interface['first_date']."'
            and time <= '".$interface['last_date']."'
            group by hour(time)
            "
        );
        return $query->result();

    }

    function getDataInterfacePerDay($interface){
        $query = $this->db->query("select DATE(time) as time, SUM(tx) as tx, SUM(rx) as rx
            from network_log where interface = '".$interface['interface']."'
            and time >= '".$interface['first_date']."'
            and time <= '".$interface['last_date']."'
            GROUP BY date(time);
            "
        );
        return $query->result();

    }


}

/* End of file Statistic_Model.php */
