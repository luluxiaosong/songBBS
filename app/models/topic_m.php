<?php if (!defined('BASEPATH')) exit('No direct script assces allowed');

class Topic_m extends CI_Model
{
    //热门话题数据 5个 首页/话题页
    public function get_topics_hot()
    {
        $this->db->select('t.topic_id, t.topic_name, t.ico, count(p.post_id) posts_count')
            ->from('topics t')
            ->where('t.topic_pid !=',0)
            ->join('posts p', 'p.topic_id = t.topic_id', 'left')
            ->group_by('t.topic_id, t.topic_name, t.ico, p.topic_id')
            ->order_by('posts_count','desc')
            ->limit(5);
        $res =$this->db->get();
        $res = $res->result_array();
        return $res;
    }
    //一级话题，用于添加话题时作为父PID
    public function get_topics()
    {
        $this->db->select('topic_id, topic_name')
            ->from('topics')
            ->where('topic_pid',0);
        $res = $this->db->get();
        $res = $res->result_array();
        return $res;
    }

    //全部话题列表 +帖子数
    public function get_topics_all()
    {
        $this->db->cache_on();
        $this->db->select('t.topic_id, t.topic_name,t.topic_pid, t.content,t.ico, count(p.post_id) posts_count')
            ->from('topics t')
            ->join('posts p','p.topic_id = t.topic_id','left')
            ->group_by('t.topic_id, t.topic_name, t.ico,t.content,t.topic_pid,p.topic_id')
            ->order_by('posts_count','asc');
        $res=$this->db->get();
        $this->db->cache_off();
        $res = $res->result_array();
        return $res;
    }

    //全部话题列表 按帖子数排序
    public function topics_all()
    {
       $this->db->select('t.topic_id, t.topic_name, t.topic_pid, count(p.post_id) as posts_count')
            ->from('topics t')
            ->join('posts p', 'p.topic_id = t.topic_id', 'left')
            ->group_by('t.topic_id, t.topic_name, topic_pid,p.topic_id')
            ->order_by('posts_count','desc');
       $res = $this->db->get();
       $res = $res->result_array();
       return $res;
    }

    //删除话题
    public function del($topic_id)
    {
        if ($this->db->delete('topics', array('topic_id' => $topic_id))) {
            //删除相关帖子,回复

            return true;
        }
    }


    //添加版块
    public function topic_add($data)
    {
        if ($this->db->insert('topics', $data)) {
            return true;
        }
    }

    //修改版块
    public function topic_edit($topic)
    {
        $this->db->where('topic_id', $topic['topic_id']);
        return $this->db->update('topics', $topic);
    }

    //根据topic_id查询 话题相关数据 帖子数 回复数
    public function get_topic_by_topic_id($topic_id)
    {
        $this->db->select('topic_name,content,topic_id,ico');
        $this->db->where('topic_id',$topic_id);
        $res = $this->db->get('topics');
        $res = $res->row_array();
        return $res;

    }

}
