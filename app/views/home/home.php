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
    <div class="main" >
          <!--左侧-->
          <div class="main_left" >
                <div >
                    <h5  style="margin-top: 10px; padding-bottom: 6px; border-bottom: #cccccc 1px solid">&nbsp;最新发布 <span style="float: right; margin-right: 12px;">今日发布：<?php echo $posts_count_today ?> &nbsp;&nbsp;&nbsp;&nbsp; 总数：<?php echo $posts_count_all ?></span></h5>
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
