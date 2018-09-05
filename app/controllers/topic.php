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
        //顶部导航
        $data['nav_active'] = 'topic';
        $data['topics'] = $this->topic_m->get_topics_all();
        $this->load->view('home/topic_list',$data);
    }
}