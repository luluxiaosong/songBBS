<?php if (!defined('BASEPATH')) exit("no script");

class User extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_m');

    }
    /*用户列表*/
    public function user_list()
    {
        $data['active'] = '用户管理';
        $data['user_list'] = $this->user_m->user_list();
        $this->load->view('admin/user_list', $data);
    }

    /*查找用户 根据用户名username*/
    public function user_find()
    {
        $data['active'] = '用户管理';
        $username = $this->input->get('username');
        $data['user_list'][0] = $this->user_m->user_by_username($username);
        $this->load->view('admin/user', $data);
    }

    /*删除用户*/
    public function del()
    {
        $uid = $this->uri->segment(4);
        if ($this->db->where('uid',$uid)->delete('users')) {
            die("<script>alert('删除成功');history.back();</script>");
        }else{
            die("<script>alert('删除失败');history.back();</script>");
        }
    }

    /*激活  users.is_active为为激活，为1激活*/
    public function change_active()
    {
        $uid = $this->uri->segment(4);
        if ($this->db->where('uid',$uid)->update('users',['is_active' => 1])) {
            die("<script>alert('操作成功');history.back();</script>");
        }
    }

//退出后台
    public function out()
    {
        unset($_SESSION['uid']);
        unset($_SESSION['username']);
        unset($_SESSION['user_type']);
        redirect('admin/login');
    }


}
