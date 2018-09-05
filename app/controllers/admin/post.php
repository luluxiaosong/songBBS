<?php if (!defined('BASEPATH')) die('No direct script access allowed');
class Post extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('post_m');
    }
    /*帖子列表*/
    public function index()
    {
        $data['active'] = "帖子管理";
        $data['posts'] = $this->post_m->get_all_posts();
        $this->load->view('admin/posts', $data);
    }

    /*删帖 同时清除相关收藏、回帖*/
    public function del($post_id)
    {
        if ($this->post_m->admin_del($post_id) == true) {
            echo "<script>alert('删除成功');history.back()</script>";
        } else {
            echo "<script>alert('删除失败');history.back()</script>";
        }
    }
    /*加精*/
    public function good($post_id)
    {
        if ($this->db->where('post_id', $post_id)->update('posts', array('is_good'=> 1 ))) {
            echo "<script>alert('加精成功');history.back()</script>";
        }
    }
    /*取消加精*/
    public function good_del($post_id)
    {
        if ($this->db->where('post_id', $post_id)->update('posts', array('is_good'=> 0 ))) {
            echo "<script>alert('取消加精成功');history.back()</script>";
        }
    }
    /*置顶*/
    public function top($post_id)
    {
        if ($this->db->where('post_id', $post_id)->update('posts', array('is_top'=> 1 ))) {
            echo "<script>alert('置顶成功');history.back()</script>";
        }
    }
    /*取消加精*/
    public function top_del($post_id)
    {
        if ($this->db->where('post_id', $post_id)->update('posts', array('is_top'=> 0 ))) {
            echo "<script>alert('取消置顶成功');history.back()</script>";
        }
    }

}
