<?php if (!defined('BASEPATH')) exit('NO script');
/*话题版块*/
class Topic extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('topic_m');

    }
    /*话题列表*/
    public function topic_list()
    {
        $data['topics'] = $this->topic_m->get_topics_all();
        $this->load->view('admin/topic_list.php', $data);
    }
    //修改话题
    public function topic_reset()
    {
        if (empty($_POST)) {
            $topic_id = $this->uri->segment(4);
            $data['topic'] = $this->topic_m->get_topic_by_topic_id($topic_id);
            $this->load->view('admin/topic_reset.php', $data);
            return;
        }
        //如果有ico上传 则执行ico修改 如果没有不改
        if ($_FILES['userfile']['name']) {
            $config['upload_path'] = MYWEB . '/uploads/ico/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '1024';
            $config['max_height'] = '7680';
            $config['file_name'] = time() . '.jpg';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload()) {
                $data = array(
                    'topic_name' => $this->input->post('topic_name'),
                    'content' => $this->input->post('content'),
                    'ico' => '/uploads/ico/' . $config['file_name']
                );
                $topic_id = $this->input->post('topic_id');

                if ($this->db->where('topic_id', $topic_id)->update('topics', $data)) {
                    echo "<script>alert('修改成功');history.back();</script>";
                } else {
                    echo "<script>alert('修改失败');history.back();</script>";
                }
            } else {
                echo "<script>alert('ICO上传失败');history.back();</script>";
            }
        }else{
            //没有ICO上传
            $data = array(
                'topic_name' => $this->input->post('topic_name'),
                'content' => $this->input->post('content'),
            );
            $topic_id = $this->input->post('topic_id');

            if ($this->db->where('topic_id', $topic_id)->update('topics', $data)) {
                echo "<script>alert('修改成功');history.back();</script>";
            } else {
                echo "<script>alert('修改失败');history.back();</script>";
            }
        }
    }

    /*添加话题*/
    public function topic_add()
    {
        if(!$_POST){
            $this->load->view('admin/topic_add');
            return;
        }
        //上传类参数
        if($_FILES['userfile']['name']) {
            $config['upload_path'] = MYWEB . '/uploads/ico/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '10000';
            $config['max_width'] = '1024';
            $config['max_height'] = '7680';
            $config['file_name'] = time() . '.jpg';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                echo "<script>alert('ICO上上传失败');history.back();</script>";
                return;
            }
            //压缩图像 150x150
            $config2['image_library'] = 'GD2';
            $config2['source_image'] = MYWEB . '/uploads/ico/' . $config['file_name'];
            $config2['width'] = 150;
            $config2['height'] = 150;
            $config2['quality'] = 100;
            $config2['new_image'] = MYWEB . '/uploads/ico/' . '_a' . $config['file_name'];
            $config['create_thumb'] = TRUE;
            $this->load->library('image_lib', $config2);

            if (!$this->image_lib->resize()) {
                echo "<script>alert('$this->image_lib->display_errors()');history.back();</script>";
                return;
            }
            $data = array(
                'topic_name' => $this->input->post('topic_name'),
                'content' => $this->input->post('content'),
                'ico' => '/uploads/ico/' . '_a' . $config['file_name']
            );
        }else { //没有ico
            $data = array(
                'topic_name' => $this->input->post('topic_name'),
                'content' => $this->input->post('content'));
        }
            if ($this->db->insert('topics', $data)) {
                echo "<script>alert('添加成功');history.back();</script>";
            } else {
                echo "<script>alert('添加失败');history.back();</script>";
            }
    }

    /*删除话题 删除相关帖子、回复*/
    public function del($topic_id)
    {
        if ($this->topic_m->del($topic_id)) {
            echo "<script>alert('删除成功');history.back()</script>";
        }
    }
}
