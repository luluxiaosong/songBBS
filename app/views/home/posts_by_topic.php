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
<style>

</style>
<body>
<!--导航头-->
<?php $this->load->view('home/common/nav'); ?>

<?php $this->load->view('home/common/topic_hot')?>

<!--主框 -->
    <div  style="margin: auto; width: 75%; background-color: #FEFEFE; border-radius: 5px;">
        <!--左侧-->
        <div class="" style="width: 68%; float: left;  margin-bottom: 40px;">
            <div class="main">
                <div class="" style="padding:10px;">
                    <img style="height: 50px; width: 60px; border-radius: 6px" src="<?php echo base_url($topic['ico']) ?>"/>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 20px;"><?php echo $topic['topic_name']; ?></span>
                    <?php if(!empty($_SESSION['uid'])):?> <a class="post_add_btn" href="<?php echo site_url('post/post_edit/'.$topic['topic_id'])?>"> + 发布</a><?php endif ?>
                    <p style="font-size: 10px; padding: 8px 0px 6px 0px;"><?php echo $topic['content'] ?> </p>
                </div>
<!--                根据条件浏览-->
                <div class="topic_option">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?php echo site_url().'/home/posts_by_topic/'.$topic['topic_id'].'?option=new'?>" id="new" class="<?php if($option == 'new') echo 'view_optioned'?>">全部</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href='<?php echo site_url().'/home/posts_by_topic/'.$topic['topic_id'].'?option=good'?>' id="good" class="<?php if($option == 'good') echo 'view_optioned'?>">精品</a>
                    <span style="float: right; margin-right: 12px;">今日发布：<?php echo $posts_count_today_by_topic ?> &nbsp;&nbsp;| &nbsp;&nbsp;总数：<?php echo $posts_count_by_topic ?></span>
                </div>
            <ul style="background-color: #FEFEFE">
                <?php $this->load->view('home/common/post_list') ?>
                <!-- 分页  -->
                <li">
                        <?php echo $page_link;?>
                </li>
            </ul>
        </div>
        </div>
        <!--右侧-->
        <div class="" style="width: 30%; float: left; padding-left: 28px; border-left: #ccc 1px solid; margin-bottom: 50px;">
            <!--     热门帖子-->
            <div  style="margin-top: 16px; padding-bottom: 20px; border-bottom: #cccccc dashed 1px;">
                <h5 style="margin-bottom: 10px;">热贴</h5>
                <?php foreach($posts_hot as $v): ?>
                    <p style="margin: 8px 0 8px 0;"><a href="<?php echo site_url('post/show/'.$v['post_id']) ?>"><?php echo $v['title'] ?></a></p>
                <?php endforeach ?>
            </div>
            <div style="margin-top: 16px; padding-bottom: 20px; border-bottom: #cccccc dashed 1px;">
                <h5 style="margin-bottom: 10px;">全部话题</h5>
                <?php foreach($topics_all as $v): ?>
                    <span class="topic_span" ><a href="<?php echo site_url('home/posts_by_topic/'.$v['topic_id']) ?>"> <?php echo $v['topic_name']?></a></span>
                <?php endforeach;?>
                <div style="clear: both"></div>
            </div>
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
        <div style="clear: both"></div>
    </div>
</body>
</html>
