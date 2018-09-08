<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $topic['topic_name'] ?>--Mybbs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?php $this->load->view('home/common/header') ?>
</head>
<script>
    //登陆状态
    var username ="<?php echo @$_SESSION['username']?>";
    // 跳转发布 检测登陆
    function edit(){
        if(username==''){
            alert('请登陆');
            return;
        }else{
            window.location.href = "<?php echo site_url('post/post_edit')?>";
        }
    }
</script>
<body>
<!--导航头-->
<?php $this->load->view('home/common/nav'); ?>
<?php $this->load->view('home/common/topic_hot')?>
    <div  class="main">
        <!--左侧-->
        <div class="main_left">
                <div style="padding:15px; margin-left: 12px">
                    <img style="height: 50px; width: 60px; border-radius: 6px" src="<?php echo base_url($topic['ico']) ?>"/>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;"><?php echo $topic['topic_name']; ?></span>
                    <?php if(!empty($_SESSION['uid'])):?> <a class="post_add_btn" href="<?php echo site_url('post/post_edit/'.$topic['topic_id'])?>"> + 发布</a><?php endif ?>
                    <p style="font-size: 10px; padding: 8px 0px 6px 0px;"><?php echo $topic['content'] ?> </p>
                </div>

                <!-- 根据条件浏览-->
                <div class="topic_option">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?php echo site_url('topic/topic_show/'.$topic['topic_id'].'?option=all') ?>" id="all" class="<?php if($option == 'all') echo 'view_optioned'?>">全部</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href='<?php echo site_url('topic/topic_show/'.$topic['topic_id'].'?option=good')?>' id="good" class="<?php if($option == 'good') echo 'view_optioned'?>">精品</a>
                    <span style="float: right; margin-right: 12px;">今日发布：<?php echo $posts_count_today_by_topic ?> &nbsp;&nbsp;| &nbsp;&nbsp;总数：<?php echo $posts_count_by_topic ?></span>
                </div>
                <ul>
                    <?php $this->load->view('home/common/post_list') ?>
                    <!-- 分页  -->
                    <li style="text-align: center">
                            <?php echo $page_link; ?>
                    </li>
                </ul>
        </div>
        <!--右侧-->
        <div class="main_right" >
            <!--     热门帖子-->
            <?php $this->load->view('home/common/post_hot') ?>
            <!-- end -->
            <!-- 全部话题列表 -->
            <?php $this->load->view('home/common/topic_all') ?>
            <!-- end -->
            <div style="margin-top: 16px; padding-bottom: 20px; border-bottom: #cccccc solid 1px;">
                <h5>关于本站</h5>
                <p style="color: #999; margin-top: 8px;">
                    &nbsp;&nbsp;&nbsp; 这是一个新手做的练习项目，尚有许多不足之处，感谢你的光临。
                </p>
            </div>
            <div class="" style="margin-top: 20px;">
                <div>
                    <h5><span class="glyphicon glyphicon-link" style=" font-size: 16px;">  </span> 友情链接</h5>
                    <p style="padding: 10px 10px 10px 20px"><a href="http://discuss.flarum.org.cn/" target="_blank">Flarum
                            中文社区</a></p>
                    <p style="padding: 10px 10px 10px 20px"><a href="http://wenda.wecenter.com/" target="_blank">WeCenter
                            问答社区</a></p>
                    <p style="padding: 10px 10px 10px 20px"><a href="http://www.startbbs.com/index.html" target="_blank">StartBBS轻量社区v2.0.0</a></p>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
</body>
</html>
