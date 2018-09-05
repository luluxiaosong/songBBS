<!DOCTYPE html>
<html>
<head>
    <title><?php echo $post['title'] ?>-Mybbs</title>
    <?php $this->load->view('home/common/header'); ?>
    <script src="<?php echo base_url('static/ueditor/ueditor.config.js') ?>"></script>
    <script src="<?php echo base_url('static/ueditor/ueditor.all.js') ?>"></script>
</head>
<style>
</style>
<body>
<?php $this->load->view('home/common/nav'); ?>
            <!-- 帖子详细内容           -->
            <div style="width: 75%; margin: auto; padding: 10px 10px 10px 25px; background-color: #FEFEFE; border-radius: 4px;">
                <div class="post_content">
                    <h3 style="padding: 0px 20px 10px 0px;"><?php echo $post['title'] ?></h3>
                    <div class="text-muted" style="padding-bottom: 5px;">
                        <a href="<?php echo site_url('user/user_home/' . $post['uid']) ?>" target="_blank">
                            <img src="<?php echo base_url($post['avatar']) ?>" style="height: 40px; width: 40px; border-radius: 50%;"/> <?php echo $post['username'] ?>
                        </a>
                        &nbsp;
                        <span><?php echo wordTime($post['addtime']); ?></span>
                        &nbsp;&nbsp;
                        <?php if ($post['is_good'] == 1): ?><span class="post_good">精</span>&nbsp;<?php endif ?>
                        <?php if ($post['is_top'] == 1): ?><span class="post_top">置顶</span><?php endif ?>
                    </div>
                    <div id="content_view" style="margin: 8px 0 15px 0;"><?php echo $post['content'] ?></div>
                    <a name="comment" href="#"></a><!-- 回复描点-->
                    <?php if (!empty($_SESSION['uid'])): ?>
                        <div style="margin-top: 16px;">
                            <a class="active_btn reply_post" href="javascript:void(0);">回复</a> &nbsp;&nbsp;
                            <?php if (@$is_collection == 1): ?><a class="active_btn" href="javascript:void(0);">已收藏</a><?php else: ?><a class="active_btn collection" href="<?php echo site_url('post/collection_add/'.$post['post_id']) ?>">收藏</a>
                            <?php endif ?>
                            &nbsp;&nbsp;
        <!--                    管理员操作-->
                            <?php if (!empty($_SESSION['uid']) && $_SESSION['user_type'] == 1): ?>
                                &nbsp;&nbsp;
                                <div style="display: inline; position: relative; ">
                                    <a href="javascript:void (0);" class="admin" style="padding:2px;  border: 1px solid blue; margin-right: 6px;"><span class="glyphicon glyphicon-chevron-down"></span> &nbsp;</a>
                                    <div class="admin_box" style="position: absolute; top:19px; left:0px; width: 70px; display:none; border: 1px solid blue;  background-color: white; z-index: 10;">
                                        <ul>
                                            <?php if ($post['is_good'] == 1): ?>
                                                <a href="<?php echo site_url('admin/post/good_del/' . $post['post_id']) ?>">
                                                    <li>取消加精</li>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo site_url('admin/post/good/' . $post['post_id']) ?>">
                                                    <li>加精</li>
                                                </a>
                                            <?php endif ?>
                                            <?php if ($post['is_top'] == 1): ?>
                                                <a href="<?php echo site_url('admin/post/top_del/' . $post['post_id']) ?>">
                                                    <li>取消置顶</li>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo site_url('admin/post/top/' . $post['post_id']) ?>">
                                                    <li>置顶</li>
                                                </a>
                                            <?php endif ?>
                                            <a href="<?php echo site_url('admin/post/del/' . $post['post_id']) ?>">
                                                <li>删除</li>
                                            </a>
                                    </div>
                                </div>
                            <?php endif ?>
        <!--                 end   管理员操作-->

                        </div>
                        <!--回复-->
                        <div id="comment_box" style="display:none ; padding: 10px 0px 10px 0px; ">
                            <div class="comment_post">
                                <form method="post" action="<?php echo site_url('comment/comment_post') ?>">
                                    <input name="post_id" id="post_id" type="hidden"
                                           value="<?php echo $post['post_id'] ?>"/>
                                    <input name="comment_num" id="" type="hidden"
                                           value="<?php echo $comment_num + 1; ?>"/>
                                    <div class="form-group">
                                        <textarea id="content" class="comment_content" name="content"
                                                  style="height: 150px; width:  600px;"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info" id="comment-submit">提交</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.panel add comment -->
                    <?php endif ?>

                    <!-- 回复列表-->
                    <div class="coment_nav" style="margin-top: 20px; border-bottom: 1px black solid; ">
                        <span style="font-size: 16px;"><?php echo $comment_num; ?>条回复</span>
                        &nbsp;&nbsp;&nbsp;
<!--                        <a href="--><?php //echo site_url("post/show/" . $post['post_id']) ?><!--">全部</a> &nbsp;&nbsp;-->
<!--                        <a href="--><?php //echo site_url("post/show/" . $post['post_id']) ?><!--">最新</a> &nbsp;&nbsp;-->
<!--                        <a class="" href="">最赞</a> &nbsp;&nbsp;-->
<!--                        <a class="" href="">只看楼主</a>-->
                    </div>
                    <div style="margin: 4px 10px 4px 0px">
                        <?php if (!empty($comments)) foreach ($comments as $v)  : ?>
                        <div class="comment_div" style="padding-bottom: 16px; border-bottom: #AAB0C6 1px solid; padding-top: 10px;">
                            <img src="<?php echo base_url($v['avatar']) ?>"
                                 style="float: left; margin:10px 12px 6px 0px; height: 50px; border-radius: 50%"/>
                            <div class="comment_" style="float: left; padding-top: 10px; width: 590px;">
                                <div class="text-muted">
                                    <a href="#"><?php echo $v['username'] ?> </a>&nbsp;▪&nbsp;
                                    <?php if ($post['username'] == $v['username']) echo "楼主&nbsp;▪&nbsp;"; ?>
                                    <a class="thumb_up <?php if ( !empty($_SESSION['thumb_'. $v['id']])) echo 'thumb_up_ed' . '" ' . ' title=' . '"' . '已赞'  ?>" href="javascript:void(0);"><span class="glyphicon glyphicon-thumbs-up"></span> <span class="thumbs"><?php echo $v['thumb_up'] ?></span></a><input class="comment_id" type="hidden" value="<?php echo $v['id'] ?>"/>
                                    &nbsp;▪&nbsp;
                                    <span style="margin-right: 10px;"><?php echo Wordtime($v['replytime']) ?></span>
                                    <span style="float: right;margin-right: 10px;"><?php echo $v['flow']?>楼</span>
                                </div>
                                <div style="margin:6px 10px 10px 0; min-height: 40px;"><?php echo $v['content'] ?></div>
                                    <div class="hover_display" style="">
                                        <!--判断是否已赞-->
                                        <a class="reply_user" style="margin-left:0px" href="javascript:void(0);">回复</a>
                                        <!--  管理员操作 删除-->
                                        <?php if (!empty($_SESSION['uid']) && $_SESSION['user_type'] == 1): ?>
                                            <a class="comment_del" style="margin-left: 20px" href="javascript:void(0);"><span class="glyphicon glyphicon-trash""></span></a><input class="comment_id" type="hidden" value="<?php echo $v['id'] ?>"/>
                                        <?php endif ?>
                                    </div>
                                    <!--            输入框  -->
                                    <div id="comment_box_user" style="display: none; padding: 10px  0px 10px  0px; margin-left: 10px; ">
                                        <div class="comment_post">
                                            <form method="post" action="<?php echo site_url('comment/comment_post') ?>">
                                                <input name="post_id" id="post_id" type="hidden"
                                                       value="<?php echo $post['post_id'] ?>"/>
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
                                    </div><!-- /.panel add comment -->
                                    <!--             end 输入框-->
                                </div>
                            <div style="clear: both"></div>
                        </div>
                        <?php endforeach; ?>
                        <div style="clear: both"></div>
                        <div class="comment_div"><?php echo $page_link ?></div>
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
        <!--        <div class="col-md-3">-->
        <!--            <div class="" style="background-color: #FEFEFE;">-->
        <!--                <h4 class="" style="padding: 10px 0 18px 20px;">推荐</h4>-->
        <!--            </div>-->
        <!--        </div>-->
<script>
    //判断登陆状态
    var username = "<?php echo @$_SESSION['username'];?>";
    //管理员操作 下拉菜单
    $(function () {
        $('.admin').click(function () {
            var obj_admin = $(this);
            var obj_admin_box = obj_admin.siblings('.admin_box');
            if (obj_admin_box.css('display') == 'none') {
                obj_admin_box.css('display', 'block');
            } else {
                obj_admin_box.css('display', 'none');
            }

        })
    })
    //编辑器 一级评论
    $(function () {
        var ue = UE.getEditor('content', {
            toolbars: [
                [
                    'bold',//加粗
                    'italic', //斜体
                    //'horizontal', //分隔线
                    //'simpleupload', //单图上传
                    //'emotion', //表情
                    'scrawl', //涂鸦
                    // 'fullscreen', //全屏
                    //'attachment', //附件
                ]
            ],
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            wordCount: false,//字数统计
            elementPathEnabled: false //路径
        });
    })
    //显示主贴回复输入框
    $(function () {
        $('.reply_post').click(function () {
            if (username != '') {
                var obj_this = $(this);
                var obj_comment_box = obj_this.parents().siblings('#comment_box');
                var comment_box_display = obj_comment_box.css('display');
                if (comment_box_display == 'none') {
                    obj_comment_box.css('display', 'block');
                    obj_this.text('收起');
                } else {
                    obj_comment_box.css('display', 'none');
                    obj_this.text('回复');
                }
            } else {
                alert('登录后才能回复！');
            }
        })

    })
    //显示回复贴回复输入框
    $(function () {
        $('.reply_user').click(function () {
            //判断登陆
            if (username != '') {
                var obj_this = $(this);
                var obj_comment_box = obj_this.parents().siblings('#comment_box_user');
                var comment_box_display = obj_comment_box.css('display');
                if (comment_box_display == 'none') {
                    obj_comment_box.css('display', 'block');
                    obj_this.text('收起');
                } else {
                    obj_comment_box.css('display', 'none');
                    obj_this.text('回复');
                }
            } else {
                alert('登陆后才能回复！');
            }
        })

    })
    // 提交回复验证 5-300字
    $(function () {
        $('form').submit(function () {
            var text = $(this).find('textarea').val().trim();
            // console.log($(this).find('textarea').val());
            // return false;
            if (text.length < 1) {
                alert('不能为空');
                return false;
            }
        });
    })
    //点赞
    $(function () {
        $(".thumb_up").click(function () {
            var obj_thumb_up = $(this);
            var obj_thumbs = obj_thumb_up.children('.thumbs');
            var thumbs = parseInt(obj_thumbs.text()) + 1;
            var obj_comment_id = obj_thumb_up.siblings(".comment_id");
            $.post(
                '<?php echo site_url('user/thumb_up')?>',
                {comment_id: obj_comment_id.val()},
                function (msg) {
                    if (msg == 'yes') {
                        obj_thumbs.text(thumbs);
                        obj_thumb_up.css('color', '#e91e63');
                        obj_thumb_up.attr('title', '已赞');
                    }else{

                    }
                }
            )
        })
    })

    //删除评论 管理员功能
    $(function () {
        $('.comment_del').click(function () {
            if(!confirm("确定删除该评论吗")){
                return;
            }
            var del_obj = $(this);
            var comment_div_obj = del_obj.parents('.comment_div');
            var comment_id = del_obj.siblings('.comment_id').val();
            $.post(
                "<?php echo site_url('admin/comment/del')?>",
                {comment_id:comment_id},
                function (msg) {
                    if(msg == "yes"){
                        comment_div_obj.hide();
                    }
                }
            )
        })
    })
</script>

</body>
</html>