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
                <div><a href="<?php echo site_url('user/user_home/'.$v['uid'])?>"><img src="<?php echo base_url($v['avatar']) ?>" style="height: 30px; width: 30px; border-radius: 15px"/>&nbsp;&nbsp;<?php echo $v['username'] ?>：</a>
                <p><?php echo $v['content']?></p>
                <a class="reply_user" style="margin-right: 10px" href="javascript:void(0);">回复</a><?php echo wordTime($v['replytime'])?>&nbsp;&nbsp;<?php echo $v['flow']?>楼
                </div>
                <!--  输入框  -->
                <div class="comment_box_user" style="display: none; padding: 10px 0px 10px 0px; ">
                    <div class="comment_post">
                        <form method="post" action="<?php echo site_url('comment/comment_post') ?>">
                            <input name="post_id" id="post_id" type="hidden"
                                   value="<?php  echo $v['post_id'] ?>"/>
                            <input name="comment_id" id="post_id" type="hidden"
                                   value="<?php echo $v['id'] ?>"/>
                            <input name="reply_uid" id="" type="hidden"
                                   value="<?php echo $v['uid'] ?>"/>
                            <input name="reply_username" id="" type="hidden"
                                   value="<?php echo $v['username']; ?>"/>
                            <div class="form-group">
                             <textarea class="form-control" class="comment_content" name="content" style="height: 80px; width: 500px;"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info comment_click"
                                        id="comment-submit">提交
                                </button>
                            </div>
                        </form>
                    </div>
                </div> 
                <!--  end 输入框-->
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
     //显示回复贴回复输入框
    $(function () {
        $('.reply_user').click(function () {
                var obj_this = $(this);
                var obj_comment_box = obj_this.parents().siblings('.comment_box_user');
                var comment_box_display = obj_comment_box.css('display');
                if (comment_box_display == 'none') {
                    obj_comment_box.css('display', 'block');
                    obj_this.text('收起');
                } else {
                    obj_comment_box.css('display', 'none');
                    obj_this.text('回复');
                }
        })
    })
</script>
</body>
</html>

