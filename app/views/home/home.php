<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBBS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?php $this->load->view('home/common/header')?>
</head>
<body>
<!--导航头-->
<?php $this->load->view('home/common/nav')?>
    <?php $this->load->view('home/common/topic_hot')?>
<!--主框 -->
    <div  style="margin: auto; width: 75%; height: auto; background-color: #FEFEFE;  border-radius: 4px;">
          <!--左侧-->
          <div class="" style="width: 68%; float: left;  margin-bottom: 50px;">

                <div class="main">
                    <h5  style="margin-top: 10px; padding-bottom: 6px; border-bottom: #cccccc 1px solid">&nbsp;全部帖子 <span style="float: right; margin-right: 12px;">今日发布：<?php echo $posts_count_today ?> &nbsp;&nbsp;&nbsp;&nbsp; 总数：<?php echo $posts_count_all ?></span></h5>
                    <ul>
                        <?php $this->load->view('home/common/post_list') ?>
                        <!-- 分页  -->
                        <li style="text-align: center">
                                <?php echo $page_link; ?>
                        </li>
                    </ul>
                </div>
          </div>
          <!--右侧            -->
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
