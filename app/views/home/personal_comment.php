<!DOCTYPE html>
<html>
<head>
    <title>我的消息--小白社区</title>
    <?php $this->load->view('home/common/header'); ?>
</head>
<body>
<?php $this->load->view('home/common/personal_info'); ?>
    <div class="panel panel-default">
        <div class="personal_nav">
            <a id="post" href="<?php echo site_url('personal/home') ?>">我的帖子</a>

            <a id="comment_for_me" class="personal_active" href="<?php echo site_url('personal/comment_for_me') ?>">@我</a>
            <a id="collection" href="<?php echo site_url('personal/collection ') ?>">收藏</a>
            <a id="follow"  href="<?php echo site_url('personal/follow') ?>">关注 </a>
            <a id="message"  href="<?php echo site_url('personal/message') ?>"><span class="glyphicon glyphicon-envelope"></span> 私信</a>
        </div>

        <div class="panel-body">
            <?php foreach($comments as $v) :?>
            <div class="comment_to_me_box">
                <?php if($v['is_reading'] == 0):?><span style="color: red">new</span> <?php endif?> 原帖：<a href="<?php echo site_url('post/show/'.$v['post_id'])?>" target="_blank"><?php echo $v['title']?></a><a href="javascript:void(0)" title="取消提醒" class="comment_to_me_del glyphicon glyphicon-remove" style="font-size:17px; float: right; margin-right: 10px"></a>
                <input type="hidden" class="comment_id" value="<?php echo $v['id']?>"/>
                <p><a href="<?php echo site_url('user/user_home/'.$v['uid'])?>"><img src="<?php echo base_url($v['avatar']) ?>" style="height: 30px; width: 30px; border-radius: 15px"/>&nbsp;&nbsp;<?php echo $v['username'] ?></a>&nbsp;&nbsp;<?php echo wordTime($v['replytime'])?> <?php echo $v['flow']?>楼 ：
                <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v['content']?></p>
                </p>
            </div>
            <?php endforeach?>
        </div>
    </div>
<script>
    //取消提醒
    $(function () {
        $('.comment_to_me_del').click(function () {
            var obj_comment_to_me_box = $(this).parents('.comment_to_me_box');
            var comment_id = $(this).siblings('.comment_id').val();
            $.ajax({
                url: '<?php echo site_url('comment/comment_notice_remove')?>',
                type: 'post',
                dataType: 'text',
                data: {comment_id: comment_id},
                success: function (data) {
                    if(data == 'yes'){
                        obj_comment_to_me_box.hide();
                    }
                }
            });
        })
    })
</script>
</body>
</html>

