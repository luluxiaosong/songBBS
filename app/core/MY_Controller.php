<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//基本控制器
class base_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        session_start();
        //网站状态
        $this->load->model('set_m');
        $site = $this->set_m->get_base_set();
        if($site['site_status'] == 0){ //关闭
            exit($site['close_message']);
        }
    }
}

//登陆用户控制器
class personal_Controller extends base_Controller
{

    function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['uid']))
            exit;
        }
}

//后台控制器
class Admin_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        session_start();
        //users.group_type为0普通用户 为1管理员
        if (empty($_SESSION['uid']) or @$_SESSION['user_type'] != 1) {
            redirect('admin/login');
        }
    }

}


