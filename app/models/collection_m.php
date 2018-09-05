<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class collection_m extends CI_Model
{
    public function is_add($uid,$post_id)
    {
        if($this->db->get_where('collections',array('uid'=>$uid,'post_id'=>$post_id))->row_array())
        {
            return 1;
        }
    }
}
