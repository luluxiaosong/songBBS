<?php if (!defined('BASEPATH')) exit('No direct acces script allowed');

class Topic extends base_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('topic_m');
        $this->load->model('post_m');

    }
    //全部话题列表
    public function topic_list()
    {
        //redis缓存 如果key存在直接输出 不存在在最后写入
        $this->load->library('RedisClass');
        //设置key
        $this->redisclass->key = md5($_SERVER['REQUEST_URI']);
        if($this->redisclass->exists()){
            $data = $this->redisclass->get();
            $this->load->view('home/topic_list', $data);
            return;
        }
        //顶部导航
        $data['nav_active'] = 'topic';
        $data['topics'] = $this->topic_m->get_topics_all();

        //写入redis
        $this->redisclass->value = $data;
        //设置过期时间 s
        $this->redisclass->expire = 2;
        $this->redisclass->setex();

        $this->load->view('home/topic_list',$data);
    }

    //按话题 展示示帖子
    public function topic_show()
    {
       //redis缓存 如果key存在直接输出 不存在在最后写入
       // $this->load->library('RedisMy');
       // $this->redismy->key = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
       // if($this->redismy->exists()){
       //      $data = $this->redismy->get();
       //      // p($data);

       //      $this->load->view('home/topic_show', $data);
       //      return;
       // }

        $topic_id = $this->uri->segment(3);
        $data['topic_id'] = $topic_id;
        //当前话题数据
        $data['topic'] = $this->topic_m->get_topic_by_topic_id($topic_id);
        //统计 话题帖子数
        $data['posts_count_by_topic'] = $this->post_m->posts_count_by_topic($topic_id);
        //统计 今日发布
        $data['posts_count_today_by_topic'] = $this->post_m->posts_count_today_by_topic($topic_id);
        //分页 首页默认为1
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        //默认以最新回复时间排序
        $data['option'] = $this->input->get('option') ? $this->input->get('option') : 'all';
        if ($data['option'] == 'all') {
            $param = [
                'rows' => $this->post_m->post_count_by_topic_id($topic_id),//当前话题下总帖子数
                'per_page' => $this->config->item('page_nums'),//每页条数
                'url' => site_url("home/posts_by_topic/$topic_id?option=all"),
                'page' => $page //当前页数
            ];
            $this->load->library('page_turn', $param);
            $left = ($page - 1) * $param['per_page']; //偏移
            $data['page_link'] = $this->page_turn->page_link();
            $data['posts'] = $this->post_m->get_posts_by_topic_id($topic_id, $param['per_page'], $left);
        }
        //精品查看
        if ($this->input->get('option') == 'good') {
            $data['option'] = 'good';
            $param = [
                'rows' => $this->post_m->post_good_count_by_topic_id($topic_id),//当前话题精品帖子数
                'per_page' => $this->config->item('page_nums'),//每页条数
                'url' => site_url("topic/show/$topic_id?option=good"),
                'page' => $page //当前页数
            ];
            $this->load->library('page_turn', $param);
            $left = ($page - 1) * $param['per_page']; //偏移
            $data['page_link'] = $this->page_turn->page_link();
            $data['posts'] = $this->post_m->get_posts_good_by_topic_id($topic_id, $param['per_page'], $left);
        }
        //热门话题
        $data['topics'] = $this->topic_m->get_topics_hot();
        //热门帖子 12条 按评论数排
        $data['posts_hot'] = $this->post_m->posts_hot();
        //全部话题
        $this->db->cache_on();
        $data['topics_all'] = $this->topic_m->topics_all();
        $this->db->cache_off();
        //写入redis
        // $this->redismy->value = $data;
        // $this->redismy->set();

        $this->load->view('home/topic_show', $data);
    }
}