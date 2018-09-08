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
    <div class="main">
        <!-- 左侧 帖子详细内容           -->
        <div class="main_left">
            <div class="post_div" style="margin:12px;">
                <h3 style="padding: 0px 20px 10px 0px;"><?php echo $post['title'] ?></h3>
                <div class="text-muted" style="padding-bottom: 5px;">
                     <a href="<?php echo site_url('user/user_home/' . $post['uid']) ?>" target="_blank">
                        <img src="<?php echo base_url($post['avatar']) ?>" style="height: 50px; width: 50px; border-radius: 50%;"/>&nbsp; <?php echo $post['username'] ?>
                     </a>&nbsp;
                     <span><?php echo wordTime($post['addtime']); ?></span>&nbsp;&nbsp;
                     <?php if ($post['is_good'] == 1): ?><span class="post_good">精</span>&nbsp;<?php endif ?> <?php if ($post['is_top'] == 1): ?><span class="post_top">置顶</span><?php endif ?>
                </div>
                <div id="content_view" style="margin: 8px 0 15px 0;"><?php echo $post['content'] ?>
                </div>
                <a name="comment" href="#"></a><!-- 回复描点-->
                <?php if (!empty($_SESSION['uid'])): ?> 
                <div style="margin-top: 16px;">
                    <a class="active_btn reply_post" href="javascript:void(0);">回复</a> &nbsp;&nbsp; 
                    <?php if (@$is_collection == 1): ?><a class="active_btn" href="javascript:void(0);">已收藏</a>
                    <?php else: ?><a class="active_btn collection" href="<?php echo site_url('post/collection_add/'.$post['post_id']) ?>">收藏</a>
                    <?php endif ?> &nbsp;&nbsp;
                     <!--   管理员操作-->
                        <?php if (!empty($_SESSION['uid']) && $_SESSION['user_type'] == 1): ?>
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
                                        </ul>
                                    </div>
                            </div>
                        <?php endif ?>
                     <!-- end 管理员操作-->
                </div>
                        <!--回复输入框-->
                        <div id="comment_box" style="display:none ; padding: 10px 0px 10px 0px; ">
                            <div class="comment_post">
                                <form method="post" action="<?php echo site_url('comment/comment_post') ?>">
                                    <input name="post_id" id="post_id" type="hidden"
                                           value="<?php echo $post['post_id'] ?>"/>
                                    <input name="comment_num" id="" type="hidden"
                                           value="<?php echo $comment_num + 1; ?>"/>
                                    <div class="form-group">
                                        <textarea id="content" class="comment_content" name="content"
                                                  style="height: 150px; width: 650px;"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info" id="comment-submit">提交</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endif ?>
            </div>
            <!-- 回复列表-->
            <div class="coment_nav" style="margin-top:20px; padding-left: 8px; border-bottom: 1px #999 solid; ">
                <span style="font-size: 17px;"><?php echo $comment_num; ?>条回复</span>
            </div>
            <div  style="margin: 4px 10px 4px 12px">
                <?php if (!empty($comments)) foreach ($comments as $v)  : ?>
                <div class="comment_div" style="padding-bottom: 10px;  padding-top: 10px;">
                    <div style="float: left; text-align: center; margin:4px 20px 6px 0px;">
                        <img src="<?php echo base_url($v['avatar']) ?>" style="display: block; margin-bottom: 5px; height: 50px; width: 50px; border-radius: 50%"/>
                        <a href="<?php echo site_url('user/user_home/'.$v['uid']) ?>"><?php echo $v['username'] ?></a>
                        <p class="text-muted"><?php if($post['uid']==
                        $v['uid']) echo '楼主' ?></p>   
                    </div>           
                    <div class="comment_" style="float: left; padding: 4px 6px 4px 8px; width: 590px; border:1px #ccc solid; border-radius: 8px;">
                        <div style="margin:6px 10px 10px 0; min-height: 70px; "><?php echo $v['content'] ?></div>
                            <div class="hover_display text-muted" >
                                 <!--判断是否已赞 -->
                                 <a class="text-muted thumb_up <?php if ( !empty($_SESSION['thumb_'. $v['id']])) echo 'thumb_up_ed' . '" ' . ' title=' . '"' . '已赞'  ?>" href="javascript:void(0);"><span class="glyphicon glyphicon-thumbs-up"></span> <span class="thumbs"><?php echo $v['thumb_up'] ?></span></a><input class="comment_id" type="hidden" value="<?php echo $v['id'] ?>"/>
                                 <a class="reply_user" style="margin-left: 10px" href="javascript:void(0);">回复</a>
                                 <!--  管理员操作 删除-->
                                 <?php if (!empty($_SESSION['uid']) && $_SESSION['user_type'] == 1): ?>
                             <a class="comment_del" style="margin-left: 10px;" href="javascript:void(0);"><span class="glyphicon glyphicon-trash""></span></a><input class="comment_id" type="hidden" value="<?phpecho $v['id'] ?>"/>
                                 <?php endif ?>
                                 <span style="float: right;margin-right: 10px;"><?php echo $v['flow']?>楼</span>
                                 <span style="float: right;margin-right: 10px;"><?php echo Wordtime($v['replytime']) ?></span>
                                    
                                 
                            </div>
                            <!--            输入框  -->
                            <div class="comment_box_user" style="display: none; padding: 10px 0px 10px 20px; ">
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
                                         <textarea class="form-control" class="comment_content" name="content" style="height: 80px; width: 550px;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info comment_click"
                                                    id="comment-submit">提交
                                            </button>
                                        </div>
                                    </form>
                                        </div>
                                    </div> 
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
        <div style="clear: both"></div>
    </div>
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
                var obj_comment_box = obj_this.parents().siblings('.comment_box_user');
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