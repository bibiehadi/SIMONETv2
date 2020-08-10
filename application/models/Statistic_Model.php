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
        $data = $this->db->query( "SELECT * FROM (SELECT * FROM network_log WHERE interface = '".$interface."'
        ORDER BY time DESC LIMIT 120 ) as ether order by id ASC "
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

    function getQuality($interface){
        $this->db->where('interface',$interface['interface']);
        $this->db->where('time >=',$interface['first_date']);
        $this->db->where('time <=',$interface['last_date']);
        $data = $this->db->get('network_quality_log');
        return $data->result();
    }

    function getStatisticQuality($interface){
        $this->db->select('max(ping_avg) as MaxPing, min(ping_avg) as MinPing, avg(ping_avg) as AvgPing, max(jitter) as MaxJitter, min(jitter) as MinJitter, avg(jitter) as AvgJitter, max(loss) as MaxLoss, min(loss) as MinLoss, avg(loss) as AvgLoss');
        $this->db->where('interface',$interface['interface']);
        $this->db->where('time >=',$interface['first_date']);
        $this->db->where('time <=',$interface['last_date']);
        $data = $this->db->get('network_quality_log');
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
        $this->db->select('max(cpu) as MaxCPU, min(cpu) as MinCPU, avg(cpu) as AvgCPU, max((memory/memory_capacity)*100) as MaxMemory, min((memory/memory_capacity)*100) as MinMemory, avg((memory/memory_capacity)*100) as AvgMemory');
        $this->db->where('time >=',$interface['first_date']);
        $this->db->where('time <=',$interface['last_date']);
        // $this->db->order_by('time', 'desc');
        // $this->db->limit(2000);
        // $this->db->limit(10);
        $data = $this->db->get('resource_log');
        return $data->row_array();
    }
}

/* End of file Statistic_Model.php */
