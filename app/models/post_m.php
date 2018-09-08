<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Post_m extends CI_Model
{

    //全部帖子 首页
    public function get_posts_all($limit,$left)
    {
        $this->db->select('p.post_id,p.title,p.content,p.is_top,p.is_good,p.addtime,p.reply_last_time,p.views,u.uid,u.username,u.avatar,t.topic_id,t.topic_name,count(c.id) as comments_count')
            ->from('posts p')
            ->join('users u','u.uid = p.uid','left')
            ->join('topics t','t.topic_id = p.topic_id','left')
            ->join('comments c','c.post_id = p.post_id','left')
            ->group_by('p.post_id,p.title,p.content,p.is_top,p.is_good,p.addtime,p.views,u.uid,u.username,u.avatar,t.topic_id,t.topic_name,c.post_id')
            ->order_by('p.reply_last_time','desc')
            ->limit($limit,$left);
        $res = $this->db->get();
        $res = $res->result_array();
        return $res;
    }
    //全部帖子数
    public function get_posts_number_all()
    {
        $this->db->select('count(*) as posts_number_all');
        $res = $this->db->get('posts');
        $res = $res->row_array();
        return $res['posts_number_all'];
    }
    //某话题帖子数
    public function post_count_by_topic_id($topic_id)
    {
        $res = $this->db->select('count(*)')->where('topic_id',$topic_id)->get('posts');
        $res = $res->row_array()['count(*)'];
        return $res;
    }
    //
    //某话题精品帖子数
    public function post_good_count_by_topic_id($topic_id)
    {
        $res = $this->db->select('count(*)')
            ->where(array('topic_id'=>$topic_id,'is_good'=>1))
            ->get('posts');
        $res = $res->row_array();
        $res = $res['count(*)'];
        return $res;
    }

    //某话题分类下的帖子列表 排序：置顶、时间
    public function get_posts_by_topic_id($topic_id,$limit,$left)
    {
        $this->db->select('p.post_id,p.title,p.content,p.is_top,p.is_good,p.addtime,p.reply_last_time,p.views,u.uid,u.username,u.avatar,t.topic_id,t.topic_name,count(c.id) as comments_count')
            ->from('posts p')
            ->where('p.topic_id',$topic_id)
            ->join('users u','u.uid = p.uid','left')
            ->join('topics t','t.topic_id = p.topic_id','left')
            ->join('comments c','c.post_id = p.uid','left')
            ->group_by('p.post_id,p.title,p.content,p.is_top,p.is_good,p.addtime,p.views,u.uid,u.username,u.avatar,t.topic_id,t.topic_name,c.post_id')
            ->order_by('p.is_top','desc')
            ->order_by('p.reply_last_time','desc')
            ->limit($limit,$left);
        $res = $this->db->get();
        $res = $res->result_array();
        return $res;
    }
    //某话题分类下的精品帖子列表
    public function get_posts_good_by_topic_id($topic_id,$limit,$left)
    {
        $this->db->select('p.post_id,p.title,p.content,p.is_top,p.is_good,p.addtime,p.reply_last_time,p.views,u.uid,u.username,u.avatar,t.topic_id,t.topic_name,count(c.id) as comments_count')
            ->from('posts p')
            ->where('p.topic_id',$topic_id)
            ->where('p.is_good',1)
            ->join('users u','u.uid = p.uid','left')
            ->join('comments c','c.post_id = p.uid','left')
            ->join('topics t','t.topic_id = p.topic_id','left')
            ->group_by('p.post_id,p.title,p.content,p.is_top,p.is_good,p.addtime,p.reply_last_time,p.views,u.uid,u.username,u.avatar,t.topic_id,t.topic_name')
            ->limit($limit,$left)
            ->order_by('p.reply_last_time');
        $res = $this->db->get();
        $res = $res->result_array();
        return $res;
    }


    //今日话题
    public function total()
    {
        $this->db->select('addtime');
        $this->db->from('posts');
        $res = $this->db->get();
        //话题总数
        $total = $res->num_rows;
        return $total;
    }
    //我的帖子总数
    public function posts_my_count()
    {
       $res = $this->db->select('count(*) as rows')->where('uid',$_SESSION['uid'])->get('posts');
       $res = $res->row_array();
       return $res['rows'];
    }
    //我的帖子
    public function get_posts_by_uid($uid, $limit= 10,$left= 0)
    {
        $this->db->select('posts.post_id,posts.title,posts.addtime,posts.is_good,posts.is_top,t.topic_id,t.topic_name,count(c.id) as comments_count')
        ->from('posts')
        ->where('posts.uid', $uid)
        ->join('topics t','posts.topic_id = t.topic_id','left')
        ->join('comments c', 'c.post_id = posts.post_id', 'left')
        ->group_by('post_id')
        ->limit($limit,$left)
        ->order_by('addtime', 'desc');
        $res = $this->db->get();
        return $res->result_array();
    }

    //某用户帖子总数
    public function posts_rows_by_uid($uid)
    {
        $res = $this->db->select('count(*) as rows')->where('uid',$uid)->get('posts');
        $res = $res->row_array();
        return $res['rows'];
    }
    //帖子详细
    public function post_by_post_id($post_id)
    {
        $this->db->select('posts.*,u.username,u.avatar, t.topic_name');
        $this->db->from('posts');
        $this->db->join('users u', 'u.uid=posts.uid', 'left');
        $this->db->join('topics t', 't.topic_id=posts.topic_id', 'left');
        $this->db->where('posts.post_id', $post_id);
        $query = $this->db->get();
        return $query->row_array();

    }

    public function comments($post_id, $limit = 15,$left)
    {
        $this->db->select('c.id,c.content,c.thumb_up,c.replytime,c.post_id,c.flow,u.uid,u.username,u.avatar')
                 ->from('comments c')
                 ->join('users u', 'u.uid=c.uid', 'left')
                 ->order_by('replytime', 'aesc')
                 ->where('post_id', $post_id)
                 ->limit($limit,$left);
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        }
    }

    public function add($data)
    {
        if ($this->db->insert('posts', $data)) {
            return $this->db->insert_id();
        }

    }

    //本人删除帖子
    public function post_del($post_id)
    {
        //确认本人 同时删除收藏记录 和评论
        if ($this->db->delete('posts',
            array('post_id' => $post_id, 'uid'=>$_SESSION['uid'])))
        {
            $this->db->delete('collections',array('post_id' => $post_id));
            $this->db->delete('comments',array('post_id' => $post_id));
            return true;
        } else {
            return false;
        }

    }

    //管理员删除
    public function admin_del($post_id)
    {
        //同时删除收藏记录 和评论
        if ($this->db->delete('posts', array('post_id' => $post_id)))
        {
            $this->db->delete('collections',array('post_id' => $post_id));
            $this->db->delete('comments',array('post_id' => $post_id));
            return true;
        } else {
            return false;
        }
    }

    //判断某人是否已经收藏某个帖子
    public function is_collection($post_id)
    {
        $res = $this->db->select('post_id')
            ->where(array('post_id'=> $post_id, 'uid' => $_SESSION['uid']))
            ->get('collections');
        $res = $res->num_rows();
//        p( $res->num_rows());
        if($res > 0){
            return 1;
        }else{
            return 0;
        }
    }
    //收藏总数
    public function collection_my_count()
    {
        $this->db->select('count(*) as collection_my_count')->where('uid',$_SESSION['uid']);
        $res = $this->db->get('collections');
        $res = $res->row_array();
        return $res['collection_my_count'];

    }

    //帖子收藏
    public function collection_by_uid($uid,$limit =50,$left =0)
    {
        $this->db->select('posts.post_id,posts.title,posts.is_good,posts.is_top,t.topic_id,topic_name,u.uid,u.username,u.avatar,collections.addtime,count(c.id) as comments_count')
                 ->where('collections.uid',$uid)
                 ->from('collections')
                 ->join('posts','posts.post_id = collections.post_id','left')
                 ->join('topics t','t.topic_id = posts.topic_id','left')
                 ->join('users u', 'u.uid = posts.uid')
                 ->join('comments c','c.post_id = collections.post_id','left')
                 ->group_by('posts.post_id,posts.title,posts.is_good,posts.is_top,t.topic_id,topic_name,u.uid,u.username,u.avatar,collections.addtime,c.post_id')
                 ->limit($limit,$left)
                 ->order_by('collections.addtime');
        $res = $this->db->get();
        $res = $res->result_array();
        return $res;
    }
    //收藏
    public function collection_add($post_id)
    {
        return $this->db->insert('collections',array('uid'=>$_SESSION['uid'],'post_id'=>$post_id,'addtime'=>time()));
    }
    //取消收藏
    public function collection_del($post_id)
    {
    return $this->db->delete('collections',array('uid'=>$_SESSION['uid'],'post_id'=>$post_id));
    }
    //统计 帖子总数
    public function posts_count_all()
    {
        $res = $this->db->select('count(*) as posts_count_all_time_all_topic')->get('posts');
        $res = $res->row_array();
        return $res['posts_count_all_time_all_topic'];
    }
    //统计 今日发布数
    public function posts_count_today()
    {
        //今日零点时间戳
        $today_time = mktime(0,0,0,date('m'),date('d'),date('Y'));;
        $this->db->select('count(*) as posts_count_today')->where('addtime >',$today_time);
        $res = $this->db->get('posts');
        $res = $res->row_array();
        return $res['posts_count_today'];
    }
    //统计 某话题帖子总数
    public function posts_count_by_topic($topic_id)
    {
        $res = $this->db->select('count(*) as posts_count_by_topic')
            ->where('topic_id',$topic_id)->get('posts');
        $res = $res->row_array();
        return $res['posts_count_by_topic'];
    }
    //某话题今日发布数
    public function posts_count_today_by_topic($topic_id)
    {
        //今日零点时间戳
        $today_time = mktime(0,0,0,date('m'),date('d'),date('Y'));;
        $this->db->select('count(*) as posts_count_today_by_topic')->where(['addtime >'=>$today_time,'topic_id' => $topic_id]);
        $res = $this->db->get('posts');
        $res = $res->row_array();
        return $res['posts_count_today_by_topic'];
    }
    //热门帖子 近三天 12条 按评论数降序排
    public function posts_hot()
    {
        //三天前时间戳 3*24*60*60=259200
        $start_time = time() - 259200;
        $this->db->select('p.post_id, p.title, count(c.id) as comments_count')
             ->from('posts p')
             ->where('addtime >',$start_time)
             ->join('comments c','c.post_id = p.post_id' , 'left')
             ->group_by('p.post_id, p.title,c.post_id')
             ->limit(12)
             ->order_by('comments_count','desc');
        $res = $this->db->get();
        $res = $res->result_array();
        return $res;
    }
    //搜索 取30条结果
    public function search($word_key)
    {
        $this->db->select('p.post_id,p.title,p.content,p.is_top,p.is_good,p.addtime,p.reply_last_time,p.views,u.uid,u.username,u.avatar,t.topic_id,t.topic_name,count(c.id) as comments_count')
            ->from('posts p')
            ->like('p.title',$word_key)
            ->join('users u','u.uid = p.uid','left')
            ->join('topics t','t.topic_id = p.topic_id','left')
            ->join('comments c','c.post_id = p.post_id','left')
            ->group_by('p.post_id,p.title,p.content,p.is_top,p.is_good,p.addtime,p.views,u.uid,u.username,u.avatar,t.topic_id,t.topic_name,c.post_id')
            ->order_by('p.reply_last_time','desc')
            ->limit(30);
        $res = $this->db->get();
        $res = $res->result_array();
        return $res;
    }
}
