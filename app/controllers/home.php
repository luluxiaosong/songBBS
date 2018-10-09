<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends base_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('topic_m');
        $this->load->model('post_m');
    }

    /* 首页
    *  显示全部帖子
    */
    public function index()
    {
       //redis缓存 如果key存在直接输出 不存在在最后写入
        $this->load->library('RedisClass');
        //设置key
        $this->redisclass->key = md5($_SERVER['REQUEST_URI']);
        if($this->redisclass->exists()){
             $data = $this->redisclass->get();
             $this->load->view('home/home.php', $data);
             return;
        }

        //导航选项
        $data['nav_active'] = 'home';
        //当前页 默认为1
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        //分页
        $param = [
            'rows' => $this->post_m->get_posts_number_all(),//总记录数
            'per_page' => $this->config->item('page_nums'),//每页条数
            'url' => site_url('home/index'),
            'page' => $page //当前页数
        ];
        $this->load->library('page_turn', $param);
        $data['page_link'] = $this->page_turn->page_link();
        $left = ($page - 1) * $param['per_page']; //偏移起点
        //帖子列表 全部 分页
        $data['posts'] = $this->post_m->get_posts_all($param['per_page'], $left);
        //热门话题
        $data['topics'] = $this->topic_m->get_topics_hot();
        //发贴统计
        $data['posts_count_today'] = $this->post_m->posts_count_today();
        $data['posts_count_all'] = $this->post_m->posts_count_all();
        //热门帖子 10条 按评论数排
        // 按时间查询 这里不能缓存
        $data['posts_hot'] = $this->post_m->posts_hot();
        //全部话题
        $this->db->cache_on(); //缓存
        $data['topics_all'] = $this->topic_m->topics_all();
        $this->db->cache_off(); 
     
         //写入redis
         $this->redisclass->value = $data;
         //设置过期时间 s
         $this->redisclass->expire = 2;
         $this->redisclass->setex();

        $this->load->view('home/home.php', $data);
    }

    //搜索
    public function search()
    {
        //热门话题导航 
        //$data['topic']['topic_id'] = 'search';
        $word_key = $this->input->get('word_key',true);
        $word_key =trim($word_key);
        if(empty($word_key)){
            redirect('home');
        }
        $data['posts'] = $this->post_m->search($word_key);
        //热门帖子 10条 按评论数排
        $data['posts_hot'] = $this->post_m->posts_hot();
        //全部话题
        $data['topics_all'] = $this->topic_m->topics_all();
        //热门话题
        //$data['topics'] = $this->topic_m->get_topics_hot();
        $this->load->view('home/search', $data);
    }
}





