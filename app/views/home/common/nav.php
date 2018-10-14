<!--  弹出层 注册Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="registerModal">注册</h4>
            </div>
            <div style="margin-bottom: 10px;margin-top: 10px">
                <form accept-charset="UTF-8" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="username">用户名</label>
                        <div class="col-sm-7">
                            <input class="form-control" id="register_username" type="text" placeholder="英文、中文，2~8位" name="register_username"/>
                            <span  class="username_tips"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="register_email">电子邮件</label>
                        <div class="col-sm-7">
                            <input class="form-control" id="register_email" name="register_email" size="50" type="email" value="" />
                            <span class="email_tips"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="register_password">密码</label>
                        <div class="col-sm-7">
                            <input class="form-control" id="register_password" name="register_password" type="password" value="" />
                            <span class="password_tips"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="user_password_confirmation">密码确认</label>
                        <div class="col-sm-7">
                            <input class="form-control" id="register_password_confirm" name="register_password_confirm" type="password" />
                            <span class="password_confirm_tips"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="vcode">验证码</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="register_vcode" name="register_vcode" type="text" />
                            <span class="vcode_tips"></span>
                        </div>
                        <div class="col-md-4">
                            <a href="javascript:register_reloadVcode();" title="点击更换"><img src="<?php echo site_url('vcode_c/get')?>" id="vcodeImg" border="0" />&nbsp;&nbsp;换一张</a>
                        </div>
                    </div>
                    <div class='form-group'>
                        <div class="col-sm-offset-2 col-sm-2">
                            <button type="button" class="btn btn-primary register_post">确认注册</button>
                        </div>
                        <div class="col-sm-6 post_tips">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<!--end 注册 -->

<!--  弹出层 登陆 -->
<div class="modal fade" id="loginModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="loginModal">登陆</h4>
            </div>
            <div style="margin-bottom: 10px;margin-top: 10px">
             <?php echo form_open('user/login',['class'=>'form-horizontal','id'=>'new_user','method'=>'post','novalidate'=>'novalidate']) ?>
            <!-- form accept-charset="UTF-8" action="<?php// echo site_url('user/login');?>" class="form-horizontal" id="new_user" method="post" novalidate="novalidate"> -->
            <div class="form-group">
                <label class="col-md-2 control-label" for="user_nickname">用户名</label>
                <div class="col-md-6">
                    <input class="form-control"  id="username" name="username" size="50" type="text" value=""/><span class="help-block red username_tips"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="password">密码</label>
                <div class="col-md-6">
                    <input class="form-control" id="password" name="password" size="50" type="password" value=""/>
                    <span class="help-block red password_tips"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="vcode">验证码</label>
                <div class="col-md-3">
                    <input class="form-control" id="vcode" name="vcode" size="50" type="text" />
                    <span class="help-block red vcode_tips"></span>
                </div>
                <div class="col-md-4">
                    <a href="javascript:reload_vcode();" title="更换验证码"><img src="<?php echo site_url('vcode_c/get')?>"  id="checkCodeImg" />&nbsp;&nbsp;换一张</a>
                </div>
            </div>
            <div class='form-group'>
                <div class="col-md-offset-2 col-md-9">
                    <button type="submit" name="commit" class="btn btn-primary">登陆</button>
                    <a href="#" class="btn btn-default" role="button">找回密码</a>
                </div>
            </div>
             </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
        </div>
     </div>
    </div>
<!--end 登陆-->

<!--顶层导航-->
    <nav id="nav" class="navbar navbar-default " >
        <div class="container-fluid">
            <div class="navbar-header"  >
              <a class="navbar-brand" style="font-size: 22px; margin-left: 120px; color: #16a295" href="<?php  echo site_url(''); ?>"> SongBBS</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <form class="navbar-form navbar-left" id="nav_form" action="<?php echo site_url('home/search')?>" method="get" accept-charset="utf-8">
              <div class="form-group">
              <input class="form-control" name="word_key" type="text"  placeholder="搜索..." >
              </div>
<!--              <button class="btn btn-default"  type="submit" ><span class="glyphicon glyphicon-search" style="color: #27943C;"></span></button>-->
          </form>
            <ul class="nav navbar-nav navbar-left">
                <li id="home" class="<?php if(@$nav_active == 'home') echo 'nav_selected' ?>"><a  href="<?php echo site_url('')?>">首页</a></li>
                <li id="topic" class="<?php if(@$nav_active == 'topic') echo 'nav_selected' ?>"><a href="<?php echo site_url('topic/topic_list')?>" title="所有话题">话题</a></li>
<!--                <li id="user" class="--><?php //if(@$nav_active == 'user') echo 'nav_selected' ?><!--"><a href="--><?php //echo site_url('user/user_list')?><!--">会员</a></li>-->
<!--                <li id="work"><a href="">作品</a></li>-->
<!--                <li id="acvitity"><a href="">活动</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right" style="margin-right: 20%">
                <!-- 未登录状态   -->
                <?php if (empty($_SESSION['uid'])){ ?>
                <li style="l"><a href="javascript;" data-toggle="modal" data-target="#registerModal""> 注册</a></li>
                <li><a href="javascript;" data-toggle="modal" data-target="#loginModal" >登录</a></li>
                    <!-- end 登陆状态 -->
                <?php }else{ ?>
                    <li><a  href="<?php echo site_url('personal/comment_for_me') ?>" title="评论@我" >@ <span id="replys_to_me" style="color:#ffeb3b;font-size: 14px"> </span> </a></li>
                    <li> <a  href="<?php echo site_url('personal/message')?>" title="私信"><span class="glyphicon glyphicon-envelope"  style="color:  ;position:relative;top:2px;"></span> <span id="messages" style="color:#ffeb3b;font-size: 14px"></span> </a></li>
                    <li id="nav_user_li"  style="position:relative; z-index:2;">
                    <a id="nav_img" href="<?php echo site_url('personal/home')?>" class="dropdown-toggle" ><img src="<?php echo base_url($_SESSION['avatar'])?>" class="img-circle" style="display: inline; height: 30px; width: 30px"> <?php echo $_SESSION['username']; ?></a>
                    <div class="user_select" style="position:absolute;top:50px;left:-20px; width: 140px; border:#6dbfff 1px solid; background-color: white">
                        <!--登陆信息                -->
                        <a href="<?php echo site_url('personal/collection')?>">收藏</a>
                        <a href="<?php echo site_url('personal/follow')?>">关注</a>
                        <a href="<?php echo site_url('personal/home')?>">个人主页</a>
                        <hr style=" width:80%;  color:#987cb9; size:1px;margin-bottom: 5px;margin-top: 5px;">
                        <a href="<?php echo site_url('personal/out') ?>">退出</a>
                    <?php if ($_SESSION['user_type'] == 1): ?> <a href="<?php echo site_url('admin/index'); ?>" target="_blank">后台</a>
                    <?php endif; ?>
                    </div>
                </li>
                <?php }; ?>
            </ul>
         </div>
        </div>
    </nav>
<script>
    //下滑菜单
    $(function(){
        $('#nav_user_li,#nav_user_li div').mousemove(function () {
            $('#nav_user_li').css("background-color","#ccc");
            $('#nav_user_li > div').css("display","block");
        })
        $('#nav_user_li,#nav_user_li div').mouseout(function () {
            $('#nav_user_li').css("background-color","#f5f5f5");
            $('#nav_user_li > div').css("display","none");
        })
    })

    //ajax获取  @通知 和 私信未读提醒
    <?php if(!empty($_SESSION['uid'])):?>
    $(function () {
            $.get(
                '<?php echo site_url('personal/notice') ?>',
                function(msg){
                    // console.log(msg);
                    if(msg.replys > 0) {
                        $('#replys_to_me').text("+" + msg.replys);
                    }
                    if(msg.messages > 0) {
                        $('#messages').text("+" + msg.messages);
                    }
                },
                'json'
            )
    })
    <?php endif?>

    //刷新验证图片
    function register_reloadVcode() {
        $("#vcodeImg").attr('src', '<?php echo site_url('vcode_C/get?');?>'+Math.random());
    }
    //格式验证 ajax注册
    $(function () {
        $(".register_post").click(function () {
            var register_username = $("#register_username").val().trim();
            var username_status = false; //
            var register_email = $("#register_email").val().trim();
            var email_status = false;
            var register_password = $("#register_password").val().trim();
            var password_status = false;
            var register_password_confirm = $("#register_password_confirm").val().trim();
            var password_confirm_status = false;
            var register_vcode = $("#register_vcode").val().trim();
            var vcode_status = false;
            //用户名 中文或字母 2~8位数 先检查格式 再检查数据库
            var username_re = /^[a-zA-Z\u4e00-\u9fa5]+$/;
            if(register_username.length <= 8 && register_username.length >= 2 && register_username.match(username_re)){
                //检测用户名是否占用ajax
                $.ajax({
                    url: "<?php echo site_url('user/check_username')?>",
                    data: {username: register_username},
                    type: "get",
                    async: false, //同步
                    datatype: "text",
                    success: function (msg) {
                        if (msg == "yes") {
                            username_status = true;
                            $(".username_tips").text("OK");
                            $(".username_tips").css('color', '#3c763d');
                        } else {
                            $(".username_tips").text('此用户名已被注册');
                            $(".username_tips").css('color', 'red');
                        }
                    }
                })
            }else{
                $(".username_tips").text('中文、英文，2~8位数');
                $(".username_tips").css('color','red');
            }
            //邮箱验证
            var email_re = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
            if(email_re.test(register_email)){
                //判断邮箱是否已经被注册 ajax
                $.ajax({
                    url: "<?php echo site_url('user/check_email')?>",
                    async: false,
                    data: {email: register_email},
                    datatype: "text",
                    success: function (msg) {
                        if (msg == "yes") {
                            email_status = true;
                            $(".email_tips").text("OK");
                            $(".email_tips").css("color", "#3c763d");
                        } else {
                            $(".email_tips").text("此邮箱已被占用");
                            $(".email_tips").css("color", "red");
                        }
                    }
                })
            }else{
                $(".email_tips").text("填写有效的电子邮箱");
                $(".email_tips").css("color","red");
            }
            //密码验证 必须只能包含字母加数字  6~12位
            var password_re = /^[a-z\d]*$/i;
            if(register_password.length >=6 && register_password.length <= 16 && password_re.test(register_password)){
                password_status = true;
                $(".password_tips").text("OK");
                $(".password_tips").css("color","#3c763d");
            }else{
                $(".password_tips").text("密码格式为字母加数字，6~12位");
                $(".password_tips").css("color","red");
            }
            //两次输入密码确认
            if(register_password_confirm === register_password && register_password.length >=6 && register_password.length <= 16 && password_re.test(register_password_confirm)){
                password_confirm_status = true;
                $(".password_confirm_tips").text("OK");
                $(".password_confirm_tips").css("color","#3c763d");
            }else{
                $(".password_confirm_tips").text("两次输入不一致");
                $(".password_confirm_tips").css("color","red");
            }
            //验证码格式检测
            $.ajax({
                url: "<?php echo site_url('vcode_c/check_vcode')?>",
                type: "get",
                data: {vcode: register_vcode},
                daattype: "text",
                async:false,
                success:function (msg) {
                    if (msg == "yes") {
                        vcode_status = true;
                        $(".vcode_tips").text("OK");
                        $(".vcode_tips").css("color", "#3c763d")
                    } else {
                        $(".vcode_tips").text("验证码错误");
                        $(".vcode_tips").css("color", "red")
                    }
                }
            })
            //全部格式验证通过 ajax提交注册
            if(username_status && email_status && password_status && password_confirm_status && vcode_status)
            {
                $.ajax({
                    url: "<?php echo site_url('user/register') ?>",
                    data: {
                        username: register_username,
                        password: register_password,
                        password_confirm: register_password_confirm,
                        email: register_email,
                        vcode: register_vcode
                    },
                    type: "post",
                    dataType: 'text',
                    success: function (msg) {
                        if (msg == "yes") {
                            $(".post_tips").html("<span class='ok'>注册成功, 注册信息已发送到你的邮箱,请注意查收。</span> <a href='<?php echo site_url("user/login")?>'>立即登陆</a>");
                        } else {
                            $(".post_tips").html('服务器错误'+ msg);
                        }
                    }
            });
            }else{
                $(".post_tips").html("<span class='error'>请检查输入</span>");
            }
        })
    })


    //登陆 sj

    //刷新验证图片
    function reload_vcode() {
        var verify = document.getElementById('checkCodeImg');
        verify.setAttribute('src', '<?php echo site_url('vcode_c/get?').'/'?>' + Math.random());
    }

    //格式验证
    $(function () {
        $("form").submit(function(){
            var username = $("#username").val().trim();
            var username_status = false;
            var password = $("#password").val().trim();
            var password_status = false;
            var vcode = $("#vcode").val().trim();
            var vcode_status = false;
            //用户名格式
            var username_re = /^[a-zA-Z\u4e00-\u9fa5]+$/;
            if(username.length <= 8 && username.length >= 2 && username.match(username_re)){
                username_status = true;
                $(".username_tips").text("")
            }else{
                $(".username_tips").text("用户名错误")
            }
            //密码格式 必须只能包含字母加数字  6~12位
            var password_re = /^[a-z\d]*$/i;
            if(password.length >5 && password_re.test(password)){
                password_status = true;
                $(".password_tips").text("");
            }else{
                $(".password_tips").text("密码错误");
            }
            //验证码检测 ajax
            $.ajax({
                url: "<?php echo site_url('vcode_c/check_vcode')?>",
                type: "get",
                data: {vcode: vcode},
                async: false,
                datatype: "text",
                success: function (msg) {
                    if(msg == "yes"){
                        vcode_status = true;
                        $(".vcode_tips").text("")
                    }else{
                        $(".vcode_tips").text("验证码错误")
                    }
                }
            })
            //验证完成
            if(vcode_status && password_status && username_status){
                return true;
            }else {
                return false;
            }
        })
    })

</script>