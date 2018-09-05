<!DOCTYPE html>
<html>
<head>
    <title>我的收藏--Mybbs</title>
    <?php $this->load->view('home/common/header'); ?>
</head>
<body>
<?php $this->load->view('home/common/personal_info'); ?>
                <div class="" style="background-color: white">
                    <div class="personal_nav">
                        <a id="post" href="<?php echo site_url('personal/home') ?>">我的帖子</a>
                        <a id="comment_for_me"  href="<?php echo site_url('personal/comment_for_me') ?>">@我</a>
                        <a id="collection"  class="personal_active" href="<?php echo site_url('personal/collection ') ?>">收藏</a>
                        <a id="follow"  href="<?php echo site_url('personal/follow') ?>">关注 </a>
                        <a id="message"  href="<?php echo site_url('personal/message') ?>"><span class="glyphicon glyphicon-envelope"></span> 私信</a>
                    </div>
                <div class=" ">
                    <ul>
                        <?php if (!empty($posts_collection)) foreach ($posts_collection as $v): ?>
                            <li class="posts_list">
                                <div>
                                    <p style="font-size: 16px; margin-bottom: 5px;">
                                        <a href="<?php echo site_url('post/show/' . $v['post_id']) ?>" target="_blank"  style="font-size: 16px;"><?php echo $v['title'] ?></a>&nbsp;&nbsp;
                                        <span style="font-size: 14px;color: #3a87ad;"><?php if ($v['is_good'] == 1) echo '精品 '; if ($v['is_top'] == 1) echo ' 置顶'; ?></span>
                                    </p>
                                    </div>
                                    <p class="text-muted" style="margin: 3px 0 0  0px;">
                                        <a href="<?php echo site_url("home/n") . '/' . $v['topic_id'] ?>" style="border-radius: 2px; border: #777 1px solid; color: #777; padding: 1px 2px 1px 2px; "><?php echo $v['topic_name'] ?></a> &nbsp;&nbsp;•&nbsp;&nbsp;<a href="<?php echo site_url('user/user_home/'.$v['uid'])?>"> <span><?php echo $v['username']?></span> </a> &nbsp;&nbsp;•&nbsp;&nbsp;<?php echo $v['comments_count'] ?>条回复</span>&nbsp;&nbsp;•&nbsp;&nbsp;<?php echo wordTime($v['addtime']); ?><span title="取消收藏" class="collection_del glyphicon glyphicon-remove" style="float: right;"></span>
                                        <input class="post_id_hidden" type="hidden" value="<?php echo $v['post_id']?>">
                                    </p>
                                    <!--回帖数-->
                            </li>
                        <?php endforeach; ?>
                        <!-- 分页  -->
                        <li style="height: 35px; padding-left: 40px;">
                                <?php echo $page_link; ?>
                        </li>
                        <?php //$this->load->view('home/common/posts_list')?>
                    </ul>
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
<script>
    //移除收藏
    $(function () {
        $('.collection_del').click(function () {
            var obj_post_li = $(this).parents('.posts_list');
            var post_id = $(this).siblings('.post_id_hidden').val();
            $.ajax({
                url: '<?php echo site_url('personal/collection_del')?>',
                type: 'post',
                dataType: 'json',
                data: {post_id: post_id},
                success: function (data) {
                    if(data.status == 'yes'){
                        obj_post_li.hide();
                    }
                }
            });
        })
    })
</script>
</body>
</html>