<!DOCTYPE html>
<html>
<head>
    <title>个人主页--小白社区</title>
    <?php $this->load->view('home/common/header'); ?>
</head>
<body>
<?php $this->load->view('home/common/personal_info'); ?>
                <div class="panel panel-default">
                    <div class="personal_nav">
                        <a id="post"  href="<?php echo site_url('personal/home') ?>">我的帖子</a>
                        <a id="comment_for_me"  href="<?php echo site_url('personal/comment_for_me') ?>">@我</a>
                        <a id="collection"    href="<?php echo site_url('personal/collection ') ?>">收藏</a>
                        <a id="follow" class="personal_active" href="<?php echo site_url('personal/follow') ?>">关注 </a>
                        <a id="message"  href="<?php echo site_url('personal/message') ?>"><span class="glyphicon glyphicon-envelope"></span>  私信</a>
                    </div>
                <div class="panel-body">
                    <?php if (!empty($follows_my)) foreach ($follows_my as $v): ?>
                    <div class="user_box">
                        <a href="<?php echo site_url('user/user_home/'.$v['uid']) ?>" target="_blank"><img  src="<?php echo base_url($v['avatar'])?>" height="30px"/><span><?php echo $v['username']?></span></a>
                    </div>
                    <?php endforeach ?>
                    <ul class="pagination"></ul>
                </div>
            </div><!-- /.posts -->
        </div><!-- /.col-md-8 -->
    </div><!-- /.row -->
</div><!-- /.container -->
<footer class="small">
    <div class="container">
        <div class="row">
        </div>
    </div>
</footer>
</body>
</html>