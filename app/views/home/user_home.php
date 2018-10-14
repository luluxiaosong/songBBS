<!DOCTYPE html>
<html>
<head>
    <title><?php echo $user['username']; ?>的主页-MyBBS</title>
    <?php $this->load->view('home/common/header'); ?>
</head>
<body>
<!--我的资料 -->
<?php $this->load->view('home/common/nav'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <!--我的资料-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-2">
                        <img style="height: 80px; width: 80px;" class="img-rounded img-responsive"
                             src="<?php echo base_url($user['avatar']); ?>" >
                    </div>
                    <div class="col-md-6" style="">
                        <p style="padding-top: 5px;"><span style="font-size: 20px;"><?php echo $user['username']; ?></span></p>
                        <p style="padding-top: 6px;"><span class="text-muted"><?php echo $user['introduction'] ?><a href=""></a></span></p>
                        <?php if(!empty($_SESSION['uid'])):?>
                        <p style="padding-top: 6px;"><?php if($is_follow == 1) :?><a href="<?php echo site_url('personal/follow_del/'.$user['uid'])?>">取关</a>&nbsp;&nbsp;&nbsp;<a class="messagebox_btn" href="javascript:">私信TA</a>
                            <?php else: ?><a  href="<?php echo site_url('user/follow_add/'.$user['uid']) ?>">关注TA</a><?php endif ?>
                        </p>
                        <?php endif?>
                        <div class="message_box" style="display: none">
                            <textarea class="form-control message_content" style="height: 80px; width: 400px ;margin-bottom: 8px; "></textarea>
                            <span class="red message_error"></span>
                            <button class="btn btn-primary message_send">发送</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end 用户的资料 -->
            <div class="panel panel-default">
    <div class="personal_nav">
        <span>TA的帖子</span>
    </div>
    <div class="panel-body">
        <ul>
            <?php if (!empty($posts_list)) foreach ($posts_list as $v): ?>
                <li class="posts_list">
                    <div>
                        <h4 style="font-size: 17px; margin-bottom: 5px;">
                            <a href="<?php echo site_url('post/show/' . $v['post_id']) ?>" target="_blank"  style=" font-weight:; color: black; font-size: 16px;"><?php echo $v['title'] ?></a>&nbsp;&nbsp;
                            <span style="font-size: 14px;color: #3a87ad;"><?php if ($v['is_good'] == 1) echo '[精品]  '; if ($v['is_top'] == 1) echo ' [置顶]'; ?></span>
                        </h4>
                    </div>
                    <p class="text-muted" style="margin:  3px 0 0  0px;"><?php echo $v['topic_name'] ?>&nbsp;&nbsp;•&nbsp;&nbsp;<?php echo $v['comments_count'] ?>条回复</span>&nbsp;&nbsp;•&nbsp;&nbsp;<?php echo wordTime($v['addtime']); ?>
                        <input class="post_id_hidden" type="hidden" value="<?php echo $v['post_id']?>">
                    </p>
                    <!--回帖数-->
                </li>
            <?php endforeach; ?>
            <!-- 分页  -->
            <li style="height: 35px; padding-left: 40px;">
                <?php echo $page_link; ?>
            </li>
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
    $(function () {
        //私信框显示/隐藏
        $('.messagebox_btn').click(function () {
            if($('.message_box').css('display') == 'none'){
                $('.message_box').css('display','block');
                $('.messagebox_btn').text('收起');
            }else{
                $('.message_box').css('display','none');
                $('.messagebox_btn').text('私信TA');
            }
        })
        //ajaxa发送私信
        $('.message_send').click(function () {
        var message_content = $('.message_content').val();
        var receiver_uid = <?php echo $user['uid']?>;
        $.ajax({
            url:'<?php  echo site_url('personal/message_add')?>',
            type:'post',
            data:{content: message_content, receiver_uid: receiver_uid},
            success:function (data) {
                if(data == 'yes'){
                    alert('发送成功!');
                    $('.message_box').css('display','none');
                    $('.messagebox_btn').text('私信TA');
                }else{
                    alert('发送失败！');
                }
            }
        })
    })

    })

</script>
</body>
</html>