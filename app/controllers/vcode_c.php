<?php if (!defined('BASEPATH')) exit('No access script allowed');
/*
 * 验证码
 * */
class vcode_c extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
    }

    //生成验证码 保存在$_SESSION['vcode']
    public function get()
    {
        $this->load->library('vcode');
        $this->vcode->show();
    }
    //ajax 检测验证码
    public function check_vcode()
    {
        $vcode = $this->input->get('vcode');
        if (strtolower($vcode) == strtolower($_SESSION['vcode'])) {
            echo "yes";
        } else {
            echo 'no';
        }
    }
}
