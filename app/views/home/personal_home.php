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
                        <a id="post" class="personal_active" href="<?php echo site_url('personal/home') ?>">我的帖子</a>
                        <a id="comment_for_me"  href="<?php echo site_url('personal/comment_for_me') ?>">@我</a>
                        <a id="collection" href="<?php echo site_url('personal/collection ') ?>">收藏</a>
                        <a id="follow"  href="<?php echo site_url('personal/follow') ?>">关注 </a>
                        <a id="message"  href="<?php echo site_url('personal/message') ?>"><span class="glyphicon glyphicon-envelope"></span> 私信</a>
                    </div>
              <div class="panel-body">

                <ul>
                  <?php if (!empty($posts_my)) foreach ($posts_my as $v): ?>

                  <li class="posts_list">
                        <div>
                            <a class="post_title" href="<?php echo site_url('post/show/' . $v['post_id']) ?>" target="_blank" >
                                <span style="color: #176890; font-size: 17px;"><?php echo $v['title'] ?></span>
                            </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;

                                <?php if ($v['is_good'] == 1): ?><span class="post_good">精</span>&nbsp;<?php endif ?>
                                <?php if ($v['is_top'] == 1): ?><span class="post_top">置顶</span><?php endif ?>
                        </div>
                      <p class="text-muted" style="margin:  3px 0 0  0px;">
                          <a class="topic_small" href="<?php echo site_url('topic/show/' . $v['topic_id']) ?>" target="_blank"><?php echo $v['topic_name'] ?></a>
                          &nbsp;&nbsp;•&nbsp;&nbsp;
                          <?php echo $v['comments_count'] ?>条回复&nbsp;&nbsp;•&nbsp;&nbsp;<?php echo wordTime($v['addtime']); ?><a class="del" style="float: right" href="javascript:void(0);">删除</a>
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
        $('#send-message').on('submit', function (e) {
            e.preventDefault();
            var receiver_uid = $('#receiver_uid').val();
            var content = $.trim($('#content').val());
            var token = $('#token').val();
            if (content == '') {
                $('#error').html('内容不能为空!');
                return false;
            }
            $.ajax({
                url: 'http://localhost/startbb/index.php/message/send',
                type: 'post',
                dataType: 'json',
                data: {receiver_uid: receiver_uid, content: content, stb_csrf_token: token},
                success: function (data) {
                    $('#content').val(data);
                    $('#message').modal('hide');
                }
            });

        });

    });
    //删除我的帖子
    $(function () {
        $('.del').click(function () {
          if(confirm('确定要删除吗')){
              var obj_li = $(this).parents('.posts_list');
              var  post_id = $(this).siblings('.post_id_hidden').val();
              $.ajax({
                  url: '<?php echo site_url('personal/post_del')?>',
                  type: 'post',
                  dataType: 'text',
                  data: {'post_id': post_id},
                  success: function (data){
                      if(data == 'del_success') {
                          alert('删除成功');
                          obj_li.hide();
                      }else{
                          alert('删除失败');
                      }
                  }
              });
          }
        })
    })
</script>
</body>
</html>