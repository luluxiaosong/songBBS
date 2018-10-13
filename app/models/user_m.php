<?php if (!defined('BASEPATH')) exit('No direct script assces allowed');

class user_m extends CI_Model
{

    //由username获取密码
    public function password($username)
    {
       $res = $this->db->select('password')
                       ->where('username',$username)
                       ->get('users');
       $res =$res->row_array();
        if(!empty($res['password'])){
            return $res['password'];
        }else{
            return false;
        }
    }
    //登录信息 uid group_type username
    public function user_info($username)
    {
        $this->db->select('uid,username,user_type,avatar')
                 ->where('username', $username);
        $res = $this->db->get('users');
        $res =$res->row_array();
        return $res;
    }
    //检测username  已存在返回false
    public function check_username($name)
    {
        $res = $this->db->where('username', $name)->get('users');
        if ($res->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    //检测邮箱 已存在返回false  可用true
    public function check_email($email)
    {
        $res = $this->db->where('email', $email)->get('users');
        if ($res = $res->num_rows > 0) {
            return false;
        } else {
            return true;
        }

    }
    //新用户入库
    public function register($data)
    {
        if ($this->db->insert('users', $data)) {
            return true;
        }else{
            return false;
        }
    }

    //登陆验证 成功返回ture 失败false
    public function login($data)
    {
        $res = $this->db->select('uid,username,password,avatar,is_active,user_type')
                        ->where('username', $data['username'])
                        ->get('users');
        if ($res->num_rows() > 0) {
            $res = $res->row_array();

            if ($res['password'] == $data['password']) {
                //判断账号状态 users.is_active为1正常，为0封号或者未激活
                if ($res['is_active'] == 0) {
                    exit("账号异常，如有需要请联系管理员");
                }
                //用户名，用户组，uid 保存到session
                $_SESSION['username'] = $res['username'];
                $_SESSION['uid'] = $res['uid'];
                $_SESSION['user_type'] = $res['user_type'];
                $_SESSION['avatar'] = $res['avatar'];
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    //权限，判断用户分类，gid=1为管理员 gid=2为版主，gid=3为普通会员
    public function user_type($username)
    {
        $res = $this->db->select('user_type')->where('username', $username)->get('users');
            $res = $res->row_array();
            return $res['user_type'];
    }

    //个人主页数据
    public function get_user_by_uid($uid)
    {
        $query = $this->db->get_where('users', array('uid' => $uid));
        return $query->row_array();
    }
    //修改基本资料
    public function base_set($data)
    {
        return  $this->db->where('uid',$_SESSION['uid'])->update('users',$data);
    }

    //根据username查询user信息:uid，passwrord,user_group
    //如果不存在则返回false
    public function user_by_username($username)
    {
        //sql过滤
        // $username = mysql_real_escape_string($username);
        p($username);
        $this->db->select('uid,username,user_type');
        $this->db->from('users');
        $this->db->where(array('username' => $username));
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $data = $query->row_array();
            return $data;
        }

    }

    //用户列表
    public function user_list()
    {
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    //删除用户
    public function del($uid)
    {
        $this->db->delete('users', array('uid' => $uid));
    }

    //获取is_active，改变账号状态
    public function change_active($uid)
    {
        $query = $this->db->select('is_active')->get_where('users', array('uid' => $uid));
        $res = $query->row_array();
        if ($res['is_active'] == 1) {
            $this->db->where('uid', $uid);
            if ($this->db->update('users', array('is_active' => 0))) {
                return true;
            } else {
                return false;
            }
        } else {
            $this->db->where('uid', $uid);
            if ($this->db->update('users', array('is_active' => 1))) {
                return true;
            } else {
                return false;
            }
        }
    }

    //根据用户名获取状态
    public function get_is_active_by_name($username)
    {
        $query = $this->db->select('is_active')->get_where('users', array('username' => $username));
        if ($query->num_rows > 0) {
            $data = $query->row_array();
            return $data['is_active'];
        }
    }

    // 我关注的用户
    public function folows($uid)
    {
        $this->db->select('u.uid,u.usernme,u.avatar, ');
    }
    //我是否关注某用户
    public function is_follow($uid)
    {
        if(!empty($_SESSION['uid'])){
           $res = $this->db->where(array('create_uid' => $_SESSION['uid'],'follow_uid' => $uid))->get('follows');
           if($res->num_rows() > 0){
              return 1;
           }else{
               return 0;
           }
        }else{
            return 0;
        }
    }

    //未读消息
    public function messages($uid)
    {
        $this->db->select('count(*)');
        $this->db->where(array('receiver_uid' => $uid, 'is_reading' => 0));
        $res = $this->db->get('messages')->row_array();
        return $res['count(*)'];
    }

    //未读@我(回复我) 除去@自己的 未读is_reading == 0 未移除 is_remove == 0
    public function replys($uid)
    {
        $this->db->select('count(*)');
        $this->db->where(array('reply_uid' => $uid, 'uid !=' => $uid, 'is_reading' => 0,
            'is_remove' => 0));
        $res = $this->db->get('comments')->row_array();
        return $res['count(*)'];
    }


}
