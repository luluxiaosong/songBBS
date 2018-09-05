<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class comment_m extends CI_Model
{

    /*
     * 某帖子的回复数
     * */
    public function comment_num($post_id)
    {
        $this->db->select('count(*) as comment_num');
        $this->db->where('post_id', $post_id);
        $res = $this->db->get('comments');
        $res = $res->row_array();
        return $res['comment_num'];

    }
    /*
     * 点赞数
     *
     *
     *  */
    public function thumbs($comment_id)
    {
       $res = $this->db->select('thumb_up')->where('id',$comment_id)->get('comments');
       $res = $res->row_array();
       return $res['thumb_up'];
    }

    /*
     * 回复间隔
     */
    public function last_time($uid)
    {
        $this->db->select_max('replytime');
        $this->db->where('uid', $uid);
        $res = $this->db->get('comments')->row_array();
        return time() - $res['replytime'];
    }
    /*
        * 楼层数
        *
     * */
    public function flow($comment_id)
    {
        $this->db->select('flow')->where('id',$comment_id);
        $res = $this->db->get('comments')->row_array();
        return $res['flow'];
    }


   /*
    * 最大楼层数
    * */
    public function flow_max($post_id)
    {
        $this->db->select('max(c.flow) as flow_max')->where('post_id',$post_id)->group_by('post_id')->from('comments as c');
        $res = $this->db->get();
        $res = $res->row_array();
        return $res['flow_max'];
    }

    /*
     * @我
     * 回复comment_id、 内容content、回复楼层flow 回复人uid、回复人名username、原帖post_id、原帖title, is_remove == 0
     * */
    public function comment_for_me()
    {
        $uid = $_SESSION['uid'];
        $this->db->select('c.id, c.content, c.is_reading, c.replytime, c.flow, u.uid,u.avatar, u.username, p.post_id, p.title')
            ->from('comments c')
            ->where('reply_uid', $uid)
            ->where('is_remove',0)
            ->where('c.uid !=',$uid)
            ->join('users u', 'u.uid = c.uid', 'left')
            ->join('posts p', 'p.post_id = c.post_id','left')
            ->order_by('c.replytime','desc')
            ->limit(30);
        $res = $this->db->get();
        return $res->result_array();

    }

    /*
     * reply_uid
     * */
    public function reply_uid($comment_id)
    {
        $this->db->select('reply_uid')->where('id',$comment_id);
        $res = $this->db->get('comments')->row_array();
        return $res['reply_uid'];
    }

}
