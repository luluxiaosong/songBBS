<?php if (!defined('BASEPATH')) exit('No access script allowed');

class collection extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['uid'])) {
            exit("<script>alert('请先登陆');history.back();</script>");
        }
//        $this->load->model('post_m');
    }

    public function add_or_del()
    {
        $post_id = $this->input->post('post_id');
        //如果已收藏 则取消收藏
        $this->load->model('post_m');
        if ($this->post_m->is_collection($post_id)) {
            if($this->post_m->collection_del($post_id)){
                exit("取消成功");
            }
        }else{ //如果没有收藏 则收藏
                if($this->post_m->collection_add($post_id)){
                    exit('收藏成功');
                }
        }
    }

    public function del()
    {
        $post_id = $this->input->post('post_id');
        $uid = $_SESSION['uid'];
        //检查是否收藏
//        $this->load->model('collection_m');
//        if($this->collection_m->is_add($uid,$post_id)){
//            exit('你已经收藏了');
//        }
        if ($this->db->del('collections', array('post_id' => $post_id, 'uid' => $uid))) {
            exit('取消成功');
        } else {
            exit('取消失败');
        }
    }


}