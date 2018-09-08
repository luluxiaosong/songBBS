<?php if (!defined('BASEPATH')) exit('No direct script assces allowed');

class Topic_m extends CI_Model
{
    //热门话题数据 6条 首页/话题页
    public function get_topics_hot()
    {
        $this->db->select('t.topic_id, t.topic_name, t.ico, count(p.post_id) posts_count')
            ->from('topics t')
            ->join('posts p', 'p.topic_id = t.topic_id', 'left')
            ->group_by('t.topic_id, t.topic_name, t.ico, p.topic_id')
            ->order_by('posts_count','desc')
            ->limit(7);
        $res =$this->db->get();
        $res = $res->result_array();
        return $res;
    }

    //全部话题列表 +帖子数
    public function get_topics_all()
    {
        $this->db->cache_on();
        $this->db->select('t.topic_id, t.topic_name, t.content,t.ico, count(p.post_id) posts_count')
            ->from('topics t')
            ->join('posts p','p.topic_id = t.topic_id','left')
            ->group_by('t.topic_id, t.topic_name, t.ico,t.content,p.topic_id')
            ->order_by('t.topic_name','asc');
        $res=$this->db->get();
        $this->db->cache_off();
        $res = $res->result_array();
        return $res;
    }

    //全部话题列表 按帖子数排序
    public function topics_all()
    {
       $this->db->select('t.topic_id, t.topic_name, count(p.post_id) as posts_count')
            ->from('topics t')
            ->join('posts p', 'p.topic_id = t.topic_id', 'left')
            ->group_by('t.topic_id, t.topic_name, p.topic_id')
            ->order_by('t.topic_name','asc');
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
