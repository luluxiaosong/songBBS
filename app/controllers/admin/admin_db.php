<?php if (!defined('BASEPATH')) die('No direct script access allowed');

//帖子管理
class Admin_db extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        // $this->load->model('post_m');
    }

    public function index()
    {
        $data['active'] = "数据库管理";
        $this->load->view('admin/admin_db.html', $data);

    }


}
