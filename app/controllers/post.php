<?php if (!defined('BASEPATH')) exit('No direct acces script allowed');

class Post extends base_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('post_m');
        $this->load->model('topic_m');
    }

    //帖子 编辑界面
    public function post_edit()
    {
        $topic_id = $this->uri->segment(3);
        //当前话题数据
        $this->load->model('topic_m');
        $data['topic'] = $this->topic_m->get_topic_by_topic_id($topic_id);
        $this->load->view('home/post_edit',$data);
    }


    // 发帖提交 成功跳转帖子详情
    public function post_add()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'topic_id' => $this->input->post('topic_id'),
            'uid' => $_SESSION['uid'],
            'addtime' => time(),
            'reply_last_time'=>time(),
            'views' => 0
        );
        //验证数据 标题字数
        $sum = mb_strlen($data['title']);
        if ($sum == 0 or $sum > 50) {
            echo "<script>alert('标题不符合要求！');window.history.back();</script>";
            exit;
        }

        //内容不能为空
        $sum_content = mb_strlen($data['content']);
        if ($sum_content == 0 || $sum_content > 30000) {
            echo "<script>alert('内容不符合要求!');window.history.back();</script>";
            exit;
        }

        //标题过滤所有标签
        $data['title'] = strip_tags($data['title']);
        //内容过滤掉js 标签
        $data['content'] = strip_tags($data['content']);

        //发布成功 跳到详情页
        if ($new_post_id = $this->post_m->add($data)) {
              //清除缓存
              $this->db->cache_delete('home','index');
              $this->db->cache_delete('home','posts_by_topic');
              $url = site_url('post/show/'. $new_post_id);
                echo "<script>alert('发布成功');location.href = '$url';</script>";
                return;
        }
    }

    //显示帖子内容和回复
    public function show()
    {
        $post_id = $this->uri->segment(3);
        //是否已收藏
        if(!empty($_SESSION['uid'])) {
            $data['is_collection'] = $this->post_m->is_collection($post_id);
        }else{
            $data['is_collection'] = 0;
        }
        $data['post'] = $this->post_m->post_by_post_id($post_id);
        //已删除
        if(empty($data['post']['post_id'])){
            exit('帖子不存在');
        }
        //回复条数
        $this->load->model('comment_m');
        $data['comment_num'] = $this->comment_m->comment_num($post_id);
        //回帖分页 当前页 默认为1
        $page= $this->input->get('page') ? $this->input->get('page') : 1;
        $param=[
           'url'=>site_url('/post/show/'.$post_id),
           'rows'=>$data['comment_num'],
           'per_page' => $this->config->item('page_comments'),//每页回复条数
           'page' =>$page,//当前页数
           'position'=> '#comment'//描点定位
        ];
        $this->load->library('page_turn', $param);
        $data['page_link'] = $this->page_turn->page_link();
        $left = ($page - 1) * $param['per_page']; //偏移起点
        $data['comments'] = $this->post_m->comments($post_id, $param['per_page'],$left);
        //热门帖子 10条 按评论数排
        $data['posts_hot'] = $this->post_m->posts_hot();
        //全部话题
        $data['topics_all'] = $this->topic_m->topics_all();
        $this->load->view('home/post', $data);
    }

     //收藏
    public function collection_add()
    {
        if(empty($_SESSION['uid'])){
            exit("<script>alert('你还没有登陆！');history.back();</script>");
        }
        $post_id = $this->uri->segment('3');
        if($this->post_m->collection_add($post_id)){
            echo '<script>history.back();</script>';
        }

    }

}

