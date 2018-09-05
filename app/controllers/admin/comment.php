<?php if (!defined('BASEPATH')) exit('No direct acces script allowed');

class Comment extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function del()
    {
        $comment_id = $this->input->post('comment_id');
        $this->db->where('id',$comment_id);
        $this->db->delete('comments');
        $res = $this->db->affected_rows();
        if($res == 1 )
        {
            echo 'yes';
        }
    }
}