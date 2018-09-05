<?php if (!defined('BASEPATH')) exit('No direct acces script allowed');

class Login extends base_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    //后台登陆界面
    public function index()
    {
        //如果已经登录 直接到后台首页
        if (!empty($_SESSION['uid']) && @$_SESSION['user_type'] == 1) {
            redirect('admin/index');
        }
        //登陆界面
        $this->load->view('admin/login.html');
    }
    /*登录操作*/
    public function do_login()
    {
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $captcha_code = $this->input->post('captcha_code');
        //保存输入数据
        $data = array(
            'password' => $password,
            'username' => $username,
        );
        //不能为空
        if (empty($password) or empty($username) or empty($captcha_code)) {
            $data['error'] = '请将信息填写完整';
            $this->load->view('admin/login', $data);
            return;
        }
        //验证码错误
        if (strtolower($captcha_code) != strtolower($_SESSION['code'])) {
            $data['error'] = '验证码错误，请重新填写';
            $this->load->view('admin/login.html', $data);
            return;
        }
        $this->load->model('user_m');
        //密码 类型
        $password_db = $this->user_m->password($username);
        //转换小写 计算MD5值 与数据库比对
        $password = md5(strtolower($password));
        if ($password != $password_db) {
            $data['error'] = '密码错误，请重新填写';
            $this->load->view('admin/login.html', $data);
            return;
        }
        //用户类型为user_type为1 否则提示 非管理员不能登陆
        $user_type = $this->user_m->user_type($username);
        if ($user_type != 1) {
            $data['error'] = '非管理员不能登陆后台';
            $this->load->view('admin/login.html', $data);
            return;
        }

        //验证通过   username user_type uid 写入session  掉转后台首页
        if ($password == $password_db && $user_type == 1)
            //根据username获取用户信息
            $user_info = $this->user_m->user_info($username);
            $_SESSION['username'] = $user_info['username'];
            $_SESSION['user_type'] = $user_info['user_type'];
            $_SESSION['uid'] = $user_info['uid'];
            $_SESSION['avatar'] = $user_info['avatar'];
            redirect('admin/index');
    }
}
