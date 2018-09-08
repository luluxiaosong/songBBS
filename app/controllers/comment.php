<?php

class comment extends personal_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('comment_m');
    }
    //回帖
    public function comment_post()
    {
        //回复
        $data=array(
            'uid'=>$_SESSION['uid'],
            'replytime'=>time(),
            'content'=>$this->input->post('content'),
            'post_id'=>$this->input->post('post_id'),
            'reply_uid'=>$this->input->post('reply_uid'),
        );
        //时间间隔20秒
        $last_time = $this->comment_m->last_time($_SESSION['uid']);
        if($last_time < 20 ){
            exit("<script>alert('回复太频繁，请20秒稍后再回复');history.back();</script>");
        }
        //如果是二级回复 查询本条回复楼层
        if($this->input->post('comment_id')){
        $reply_flow = $this->comment_m->flow($this->input->post('comment_id'));
         }
        //查询最大楼层数
        $flow_max = $this->comment_m->flow_max($this->input->post('post_id'));
        $data['flow'] = $flow_max + 1;
        //如果有@ 在内容开头追加@username.楼层
        if(!empty($this->input->post('reply_username'))){
            $data['content'] = "<span style =\"color : #d69019; font-size: 14px;\">@{$this->input->post('reply_username')}&nbsp;#{$reply_flow}楼 &nbsp;&nbsp; </span>{$data['content']}";
        }
        $this->db->insert('comments',$data);
        if( $this->db->affected_rows() > 0 ){
            //更新帖子最后回复时间
            $this->db->where('post_id',$data['post_id'])->update('posts',array('reply_last_time'=> $data['replytime']));

            echo "<script>alert('回复成功');history.back();</script>";
        }else{
            echo "<script>alert('回复失败');history.back();</script>";
        }
    }
    //移除通知 先确认是@本人的  ajax
    public function comment_notice_remove()
    {
        $comment_id = $this->input->post('comment_id');
        $comment_reply_uid = $this->comment_m->reply_uid($comment_id);
        //本人才能操作
        if ($_SESSION['uid'] == $comment_reply_uid) {

            if ($this->db->where('id', $comment_id)->update('comments', array('is_remove' => 1))) {
                echo 'yes';
            }

        }
    }


}
?>