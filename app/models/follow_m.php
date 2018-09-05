<?php if(!defined('BASEPATH')) exit('NO access script');

class Follow_m extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function follows_my()
    {
        $this->db->select('u.username,u.uid,u.avatar,f.addtime')
            ->from('follows f')
            ->where('f.create_uid',$_SESSION['uid'])
            ->join('users u','f.follow_uid = u.uid','left')
            ->order_by('f.addtime','desc');
        $res = $this->db->get();
        return $res->result_array();
    }

}