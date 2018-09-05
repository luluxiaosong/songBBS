<?php if (!defined('BASEPATH')) exit('No direct acces script allowed');

class index extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    //后台首页
    public function index()
    {
        //后台首页 数据统计
        $this->load->model('totels_m');
        $data['totel'] = $this->totels_m->totels_admin();
        $this->load->view('admin/index', $data);
    }
}
