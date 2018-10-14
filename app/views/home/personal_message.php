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
                    <a id="comment_for_me"  href="<?php echo site_url('personal/comment_for_me') ?>">@我</a>
                    <a id="collection" href="<?php echo site_url('personal/collection') ?>">收藏</a>
                    <a id="follow"  href="<?php echo site_url('personal/follow') ?>">关注 </a>
                    <a id="message" class="personal_active" href="<?php echo site_url('personal/message') ?>"><span class="glyphicon glyphicon-envelope"></span> 私信</a>

                </div>
                <div class="panel-body">
                    <ul>
                        <?php if (!empty($messages)) foreach ($messages as $v): ?>
                        <li class="messaqges_list" style="border-bottom: 1px #ccc solid; line-height: 25px; padding-bottom: 10px; margin-top: 10px;">
                            <?php if($v['sender_uid'] !== $_SESSION['uid']):?>
                            <span class="view_state" style="padding: 2px;"><?php if($v['is_reading'] == 0) echo '未读'; else echo '已读' ;?></span>
                            <?php endif?>
                            &nbsp;&nbsp;&nbsp;<span style="color: #999"><?php echo date('Y-m-d H:i:s',$v['create_time'])?></span>&nbsp;&nbsp;&nbsp;来自&nbsp;
                            <a href="<?php echo site_url('user/user_home/'.$v['sender_uid'])?>" target="_blank"><img style="height: 20px; margin-right:;float:  ; border-radius:50%;" src="<?php echo base_url($v['avatar']); ?>"/> <span style="font-size: 16px;"><?php echo $v['username']?></span></a>
                            &nbsp;&nbsp;&nbsp;
                            <a class="message_view" href="javascript:void(0)" style="color: #1c90f5; font-size: 14px;">查看</a>
                            <input class="message_id" type="hidden" value="<?php echo $v['id']?>">
                            <input class="is_reading" type="hidden" value="<?php echo $v['is_reading']?>">
                            <div class="message_content" style="display: none; margin-bottom: 12px; ">
                                <div style="border: 1px solid #ccc; border-radius: 8px; min-height: 60px; width: 500px; padding: 6px 8px 6px 8px;"> <?php echo $v['content']?></div>
                                <a class="reply_btn" href="javascript:void(0)" style="color: #1c90f5; font-size: 14px;">回信</a>
                                &nbsp;<a class="message_del" href="javascript:void(0)" style="color: red; font-size: 14px;">删除</a>
                                <input class="message_id" type="hidden" value="<?php echo $v['id']?>">
                            <div  class="message_reply_box" style="display: none">
                                <input class="sender_uid" type="hidden" value="<?php echo $v['sender_uid']?>">
                                <textarea class="form-control message_reply_content"  style="min-height:60px; width: 500px"></textarea><br/>
                                <button class="btn btn-info send_message" >发送</button>
                            </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <!-- 分页  -->
                        <li style="height: 35px; padding-left: 40px;">
                            <p class="home_page">
                                <?php echo $page_out; ?>
                            </p>
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
    //为导航栏当前选项加下划线
    var option = "<?php echo @$option?>";
    $('#' + option).css({'color': '#23527c', 'border-bottom': '2px solid blue'});

    //未读消息显示为红色
    $('.view_state').each(function () {
        if($(this).text() == '未读') {
            $(this).css({'color':'yellow','background-color':'#1292d2'});
        }
    })

    //弹出回复框
    $('.reply_btn').click(function(){
        var obj_message_reply_box = $(this).siblings('.message_reply_box');
        var message_reply_box = obj_message_reply_box.css('display');
        if( message_reply_box=='none')
        {
            $(obj_message_reply_box).css('display', 'block');
            $(this).text('收起');
        }else{
            $(obj_message_reply_box).css('display','none');
            $(this).text('回信');
        }
    })
    //发送回信
    $('.send_message').click(function () {
        var message_content = $(this).siblings('.message_reply_content').val();
        var receiver_uid = $(this).siblings('.sender_uid').val();
        var obj_message_reply_box = $(this).parents('.message_reply_box');
        $.ajax({
            url: '<?php echo site_url('personal/message_add')?>',
            type:'post',
            data_type:'text',
            data: {content:message_content,receiver_uid:receiver_uid},
            success: function (data) {
                if(data == 'yes'){
                    alert('发送成功');
                    obj_message_reply_box.hide();
                }else{
                    alert('发送失败');
                }
            }
            })
    })

    //查看按钮 显示/隐藏 消息内容 同时ajax修改阅读状态 令is_reading = 1
    $('.message_view').click(function () {
        //当前按钮对象
        var obj_message = $(this);
        var message_id = obj_message.siblings('.message_id').val();
        //消息状态 0未读 1已读
        var is_reading = obj_message.siblings('.is_reading').val();
        //消息状态显示对象
        var obj_state = obj_message.siblings('.view_state');
        //消息内容对象
        var obj_message_content = obj_message.siblings('.message_content');
        //display的值
        var message_content_display = obj_message.siblings('.message_content').css('display');
        if( message_content_display == 'none'){
            obj_message_content.css('display','block');
            obj_message.text('收起');
            //如果是未读  ajax修改数据库
            if(is_reading == 0) {
                $.post(
                    '<?php echo site_url('personal/message_state')?>',
                    {'message_id': message_id},
                    //修改成功 标为已读
                    function (msg) {
                        if (msg == 'success') {
                            obj_state.text('已读');
                            obj_state.css({'color': 'black', 'background-color': 'white'});
                               //顶端导航修改消息提醒数
                                $.get(
                                    '<?php echo site_url('user/user_login') ?>',
                                    {uid: <?php echo $_SESSION['uid']?>},
                                    function(msg) {
                                        if (msg.messages > 0) {
                                            $('#messages').text("+" + msg.messages);
                                        }
                                        //如果没有未读消息则改为空
                                        if(msg.messages == 0){
                                            $('#messages').text("");
                                        }
                                    },
                                    'json'
                                )
                        }
                    }
                )
            }
        }else{
            obj_message_content.css('display','none');
            obj_message.text('查看');
        }
    })

    //删除消息
    $(function () {
        $('.message_del').click(function () {
           if(confirm('确认要删除本条消息吗')) {
               var message_id = $(this).siblings('.message_id').val();
               //当前li
               var obj_li = $(this).parent().parent();
               $.post(
                   '<?php echo site_url('personal/message_del');?>',
                   {'message_id': message_id},
                   function (msg) {
                       if (msg == 'success') {
                           //删除成功 隐藏本条消息
                           obj_li.hide();
                       }else{
                           alert('删除失败');
                       }
                   }
               )
           }
        })
    })
</script>
</body>
</html>