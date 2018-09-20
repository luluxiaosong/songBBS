<?php if (!defined('BASEPATH')) exit('No access script allowed');

class user extends base_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('post_m');
        $this->load->helper('form');
    }

    //ajax检测用户名
    public function check_username()
    {
        $username = $this->input->get('username');
        if (!empty($username)) {
            //可用返回true
            if ($this->user_m->check_username($username)) {
                echo 'yes';
            }else{
                echo 'no';
            }
        }
    }
    //ajax 检测邮箱 可用返回yes
    public function check_email()
    {
        $email = $this->input->get('email');

        if( $this->user_m->check_email($email ) ) {
            echo "yes";
        }else{
            echo 'no';
        }
    }

    /*注册新用户 ajax
     *前端做了所有检测 后端只需保证安全 无需返回提示信息 检测不通过直接exit
     */
    public function register()
    {
        //注册界面
        if(empty($_POST['username'])){
            $this->load->view('home/register');
            return;
        }
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $vcode = $this->input->post('vcode');
        //验证码检测
        if (strtolower($_SESSION['vcode']) !== strtolower(trim($vcode))){
            exit;
        }
        //电子邮件检测
        if ($this->user_m->check_email($email) == false) {
            exit;
        }
        //用户名检测  1.格式 2.是否占用
        $username_re = "/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u";
        if(!preg_match($username_re,trim($username),$res)){
            exit;
        }
        if ($this->user_m->check_username($username) == false) {
            exit;
        }
        //检测通过 入库 密码MD5加密
        $data = [
            'username' => trim($username),
            'email' => trim($email),
            'password' => md5(trim($password)),
            'regtime' => time()
        ];

        if ($this->user_m->register($data)) {
            //发送注册成功通知邮件。。。
            echo "yes";
        }
    }

    public function login()
    {
        //登陆页面
        if(empty($_POST['username'])){
            $this->load->view('home/login');
            return;
        }
        //验证码判断
        if (strtolower($_SESSION['vcode']) !== strtolower($this->input->post('vcode'))) {
            exit;
        }
        //用户名密码判断
        $data['username'] = strtolower($_POST['username']);
        $data['password'] = md5(strtolower($_POST['password']));
        //登陆成功
        if ($this->user_m->login($data)) {
            redirect('home');
        } else {
            echo "<script>alert('用户名或密码不正确，请重新输入'); history.go(-1); reload_vcode(); </script>";
        }
    }


    //查看某用户主页
    public function user_home()
    {
        $uid = $this->uri->segment(3);
        //基本资料
        $data['user'] = $this->user_m->get_user_by_uid($uid);
        //我是否已关注TA
        $data['is_follow'] = $this->user_m->is_follow($uid);
        //分页
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $param = array(
        'url'=> site_url("user/user_home/$uid"),
        'page'=> $page,
        'per_page'=> $this->config->item('page_nums'),
        'rows' => $this->post_m->posts_rows_by_uid($uid)
    );
        $this->load->library('page_turn',$param);
        $left = $this->page_turn->left();
        $data['page_link'] = $this->page_turn->page_link();
        $data['posts_list'] = $this->post_m->get_posts_by_uid($uid,$param['per_page'],$left);

        $this->load->view('home/user_home', $data);
    }
    //添加关注
    public function follow_add()
    {
        //判断登陆
        if(empty($_SESSION['uid'])){
            echo "<script>alert('请登陆！');history.back()</script>";
            exit;
        }
        //关注对象uid
        $follow_uid = $this->uri->segment(3);
        if($this->db->insert('follows',array('create_uid'=>$_SESSION['uid'], 'follow_uid'=>$follow_uid))){
            echo "<script>alert('关注成功');history.back();</script>";
            return;
        }
    }


    //会员列表
    public function user_list()
    {
        $data['nav_active'] = 'user';
        $data['users'] = $this->user_m->user_list();
        $this->load->view('home/user_list',$data);
    }

    //ajax 点赞 判断$_SESSION['thumb_up_xx']
    public function thumb_up()
    {
        $comment_id = $this->input->post('comment_id');
        //已赞
        if( !empty($_SESSION['thumb_'.$comment_id]) ){
            exit('NO');
        }else{
            $this->load->model('comment_m');
            $thumbs = $this->comment_m->thumbs($comment_id);
            if($this->db->where('id', $comment_id)
                ->update('comments',array('thumb_up'=>$thumbs + 1)))
            {
                $_SESSION['thumb_'.$comment_id] = 1;
                echo 'yes';
            }else{
                echo 'no';
            }


        }
    }

    //退出登陆
    public function out()
    {
        unset($_SESSION['uid']);
        unset($_SESSION['username']);
        unset($_SESSION['user_type']);
        redirect('home');
    }

}

?>
