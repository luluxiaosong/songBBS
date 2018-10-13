<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends base_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('topic_m');
        $this->load->model('post_m');
    }

    /**
     *  首页
     *  显示全部最新帖子
     */
    public function index()
    {
        //redis缓存
        if($this->config->item('is_redis')) {
            $this->load->library('RedisClass');
            //设置key
            $this->redisclass->key = md5($_SERVER['REQUEST_URI']);
            //判断是否存在key 有则获取数据直接渲染页面 没有则到数据库读取并且写入redis
            if ($this->redisclass->exists()) {
                $data = $this->redisclass->get();
                $this->load->view('home/home.php', $data);
                return;
            }
        }

        //导航选项
        $data['nav_active'] = 'home';
        //当前页 默认为1
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        //分页参数
        $param = [
            'rows' => $this->post_m->get_posts_number_all(),//总记录数
            'per_page' => $this->config->item('page_nums'),//每页条数
            'url' => site_url('home/index'),
            'page' => $page //当前页数
        ];
        $this->load->library('page_turn', $param);
        $data['page_link'] = $this->page_turn->page_link();
        $left = ($page - 1) * $param['per_page']; //sql偏移起点
        //最新帖子列表 时间降序全部 带分页
        $data['posts'] = $this->post_m->get_posts_all($param['per_page'], $left);
        //热门话题 6条
        $data['topics'] = $this->topic_m->get_topics_hot(6);
        //发贴统计
        $data['posts_count_today'] = $this->post_m->posts_count_today();//今日发布数
        $data['posts_count_all'] = $this->post_m->posts_count_all(); //全部
        //热门帖子 10条 按评论数排序
        $data['posts_hot'] = $this->post_m->posts_hot(10);
        //全部话题
        $this->db->cache_on(); //文件缓存
        $data['topics_all'] = $this->topic_m->topics_all();
        $this->db->cache_off(); 
     
         //写入redis
        if($this->config->item('is_redis')) { //如果开启redis
            //写入全部数据
            $this->redisclass->value = $data;
            //设置过期时间 s
            $this->redisclass->expire = 2;
            $this->redisclass->setex();
        }
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





