<?php if (!defined('BASEPATH')) exit('No direct acces script allowed');
//个人主页
class personal extends personal_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('post_m');
    }

    //我的主页 显示个人资料和我的帖子
    public function home()
    {
        $uid = $_SESSION['uid'];
        //我的个人资料
        $data['user'] = $this->user_m->get_user_by_uid($uid);
        //我的贴子 分页
        $page = $this->input->get('page') ? $this->input->get('page'):1;
        $param=array(
            'url'=>site_url('personal/home'),
            'rows'=>$this->post_m->posts_my_count(),
            'page'=>$page,
            'per_page'=> $this->config->item('page_nums')
        );
         $left = ($page-1)*$param['per_page'];
         $this->load->library('page_turn',$param);
         $data['page_link'] = $this->page_turn->page_link();
         $data['posts_my'] = $this->post_m->get_posts_by_uid($uid,$param['per_page'],$left);
         $this->load->view('home/personal_home', $data);
    }

    /*
   * ajax获取通知 @我、私信 顶部导航
   * */
    public function notice()
    {
        $uid = $_SESSION['uid'];
        $replys = $this->user_m->replys($uid); //@我提醒
        $messages = $this->user_m->messages($uid); //消息提醒
        $arr = array('replys' => $replys, 'messages' => $messages);
        echo json_encode($arr);

    }


    //帖子收藏列表
    public function collection()
    {
        $uid = $_SESSION['uid'];
        //我的个人资料
        $data['user'] = $this->user_m->get_user_by_uid($uid);
        //我的帖子收藏 分页
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $param = array(
            'url' => site_url('personal/collection'),
            'rows' => $this->post_m->collection_my_count(),
            'page' => $page,
            'per_page' => $this->config->item('page_nums')
        );
        $this->load->library('page_turn',$param);
        $left = $this->page_turn->left();//偏移
        $data['page_link'] = $this->page_turn->page_link();
        $data['posts_collection'] = $this->post_m->collection_by_uid($uid,$param['per_page'],$left);
        $this->load->view('home/personal_collection', $data);
    }
    //移除收藏 AJAX
    public function collection_del()
    {
        $post_id = $this->input->post('post_id');
        if($this->post_m->collection_del($post_id) == true) {
            $json = array(
                'status' => 'yes'
            );
            echo json_encode($json);
        }
    }

    //@我 comment_for_me
    public function comment_for_me()
    {
        $uid = $_SESSION['uid'];
        //我的个人资料
        $data['user'] = $this->user_m->get_user_by_uid($uid);
        $this->load->model('comment_m');

        $data['comments'] = $this->comment_m->comment_for_me();
        //修改is_reading == 1
        $this->db->where('reply_uid',$uid)->update('comments',array('is_reading' => 1));
        $this->load->view('home/personal_comment',$data);

    }

    //关注列表
    public function follow()
    {
        $this->load->model('follow_m');
        $uid = $_SESSION['uid'];
        //我的个人资料
        $data['user'] = $this->user_m->get_user_by_uid($uid);
        $data['follows_my'] = $this->follow_m->follows_my($uid);
        $this->load->view('home/personal_follow', $data);
    }
    //私信列表
    public function message()
    {
        $uid = $_SESSION['uid'];
        //我的个人资料
        $data['user'] = $this->user_m->get_user_by_uid($uid);
        $this->load->model('message_m');
        $message_rows  = $this->db->select('id')->get_where('messages',['receiver_uid'=>$uid])->num_rows();
        //分页
        $this->load->library('pagination');
        $config['base_url'] = site_url('personal/message/');
        $config['total_rows'] = $message_rows;
        $config['per_page'] = 1;
        $this->pagination->initialize($config);
        $data['page_out'] = $this->pagination->create_links();
        $now_page = $this->uri->segment(3) ? $this->uri->segment(3):0; //0页开始
        $data['messages'] = $this->message_m->myMessage($uid,$config['per_page'],$now_page*$config['per_page']);

        $this->load->view('home/personal_message', $data);
    }

    //AJAX 查看私信 修该阅读状态is_reading为0
    public function message_state()
    {
        $message_id = $this->input->post['message_id'];
        $uid = $_SESSION['uid'];
        $this->db->where(array('id'=>$message_id,'receiver_uid'=>$uid));
        if($this->db->update('messages',array('is_reading'=>1))){
            echo 'success';
        }

    }
    //删除私信 AJAX
    public function message_del()
    {
        $message_id = $this->input->post('message_id');
        $uid = $_SESSION['uid'];

        $this->db->where(array('id'=>$message_id,'receiver_uid' => $uid ));

        if($this->db->delete('messages')){
            echo 'success';
        }

    }
    //发送私信
    public function message_add()
    {
        $data =array('sender_uid' => $_SESSION['uid'],
                     'create_time' => time(),
                     'receiver_uid' => $this->input->post('receiver_uid'),
                     'content' => $this->input->post('content'));
        if($this->db->insert('messages',$data)){
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    //删除帖子
    public function post_del()
    {
        $post_id = $this->input->post('post_id');
        if($this->post_m->post_del($post_id) == true){
            echo 'del_success';
        }else{
           echo 'del_false';
        }
    }

    //修改资料 界面
    public function set()
    {
        $uid = $_SESSION['uid'];
        $data['user'] = $this->user_m->get_user_by_uid($uid);
        $this->load->view('home/personal_set',$data);
    }
    //修改基本资料
    public function base_set()
    {
        //检验数据
        $data = array(
            'signature'=>$this->input->post('signature'),
            'introduction'=>$this->input->post('introduction')
        );
        if($this->user_m->base_set($data)){
            echo "<script>alert('修改成功');history.back();</script>";
        }else{
            echo "<script>alert('修改失败了');history.back();</script>";
        }
    }
    //修改头像
    public function avatar_set()
    {   
        $uid = $_SESSION['uid'];
        $config['upload_path'] = WEBROOT.'/uploads/avatar/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '1024*600'; //600k限制
        $config['max_width'] = '1000';
        $config['max_height'] = '10000';
        //上传文件名随机生成
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        //上传成功
        if ($this->upload->do_upload()) {
            //返回上传信息
            $file_upload_info =  $this->upload->data();
            //返回文件全路径
            $file_path_upload = WEBROOT.'/uploads/avatar/'.$file_upload_info['file_name'];

            //压缩头像为 150X140
            $config_2['image_library'] = 'gd2';
            $config_2['source_image'] = $file_path_upload;//读取上传的文件
            $config_2['create_thumb'] = TRUE;
            $config_2['maintain_ratio'] = TRUE;
            $config_2['width'] = 150;
            $config_2['height'] = 140;
            $this->load->library('image_lib', $config_2);
            if($this->image_lib->resize()){ //压缩成功 默认文件名添加_thump 这里须手动修改
                //后缀
                $ext = strrchr($file_upload_info['file_name'],'.');
                //文件名无后缀
                $file_basename = basename($file_upload_info['file_name'],$ext);
                //生成最终文件名
                $file_name = $file_basename.'_thumb'.$ext;
                //修改数据库用户头像路径
                $this->db->where('uid',$uid)->update('users',array('avatar'=>'/uploads/avatar/'.$file_name));
                //删除原文件
                unlink($file_path_upload);
                //删除原头像
                unlink(WEBROOT.$_SESSION['avatar']);
                //修改当前用户头像url
                $_SESSION['avatar'] = '/uploads/avatar/'.$file_name;
                echo "<script>alert('头像修改成功');history.back();</script>";
            }
        }else {
                //上传失败返回错误信息
                $error = $this->upload->display_errors('\n','');
                echo "<script>alert('头像修改失败: $error');history.back();</script>";
            }
    }

        //@我的评论 暂时不写
   /* public function comment()
    {
        $uid = $_SESSION['uid'];
        //我的个人资料
        $data['user'] = $this->user_m->get_user_by_uid($uid);
        $data['option'] = "comment";
        //@我 的评论 时间顺序
        $data['comments'] = $this->comment_m->comments('$uid');

    }*/

    //修改个人资料页面
    public function set_user_info($action = 'base_info')
    {
        if (empty($_SESSION['uid'])) {
            redirect('user/login_html');
        }
        $data['action'] = $action;
        $data['user'] = $this->user_m->get_user_by_uid($_SESSION['uid']);
        $this->load->view('home/set_user_info', $data);
    }


    //取消关注
    public function follow_del()
    {
        //取消对象uid
        $follow_uid = $this->uri->segment(3);
        $create_uid = $_SESSION['uid'];
        if($this->db->where(array('create_uid'=> $create_uid,'follow_uid'=>$follow_uid))->delete('follows')){
            exit("<script>alert('取消成功！');history.back()</script>");
        }

    }


    //退出
    public function out()
    {
        unset($_SESSION['uid']);
        unset($_SESSION['username']);
        unset($_SESSION['type']);
        redirect('home');
    }

}