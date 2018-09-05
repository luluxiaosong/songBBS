<?php if (!defined('BASEPATH')) exit('No direct acces script allowed');

class totels_m extends CI_Model
{
    //后台首页统计数据
    public function totels_admin()
    {
        // $totels['posts_today']
        // $totels['registers_today']
        // $totels['comments_today']
        // $totels['registers']
        //帖子总数
        $sql = 'select count(*) as posts from bbs_posts';
        $res = $this->db->query($sql)->row_array();
        $totels['posts'] = $res['posts'];
        //评论总数
        $sql = 'select count(*) as comments from bbs_comments';
        $res = $this->db->query($sql)->row_array();
        $totels['comments'] = $res['comments'];
        //用户数
        $sql = 'select count(*) as users from bbs_users';
        $res = $this->db->query($sql)->row_array();
        $totels['users'] = $res['users'];
        $time = strtotime("yesterday");//昨天0点时间戳
        //今日帖子数
        $sql = 'select count(*) as posts_today from bbs_posts where addtime >' . $time;
        $res = $this->db->query($sql)->row_array();
        $totels['posts_today'] = $res['posts_today'];
        //今日注册数
        $sql = 'select count(*) as users_today from bbs_users where regtime >' . $time;
        $res = $this->db->query($sql)->row_array();
        $totels['users_today'] = $res['users_today'];
        //今日评论数
        $sql = 'select count(*) as comments_today from bbs_posts where addtime >' . $time;
        $res = $this->db->query($sql)->row_array();
        $totels['comments_today'] = $res['comments_today'];
        return $totels;
    }
}
