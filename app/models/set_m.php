<?php if(!defined('BASEPATH')) exit('No direct acces script allowed');

class Set_m extends CI_Model{

    public function get_base_set()
    {
        $res = $this->db->get('set');
        $res = $res->row_array();
        return $res;
    }
}