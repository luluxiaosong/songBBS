<?php if( ! defined('BASEPATH')) exit('not allow');

class Set extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function base_set()
    {
        if(empty($_POST)) {
            $this->load->model('set_m');
            $data['base_set'] = $this->set_m->get_base_set();
            $this->load->view('admin/base_set.php',$data);
            return;
        }
        $data['site_status'] = $this->input->post('site_status',true);
        $data['close_message'] = $this->input->post('close_message',true);
        if($this->db->update('set',$data)){
            echo "<script>alert('保存成功');history.back()</script>";
        }
    }
    //清空本地数据库缓存
    public function cache_del_all()
    {
        $this->db->cache_delete_all();
        redirect('admin/index');
    }
}