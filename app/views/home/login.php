<!DOCTYPE html><html>
<head>
    <meta charset='UTF-8'>
    <title>登录 - 社区</title>
    <?php $this->load->view('home/common/header');?>
</head>
<body>
<?php $this->load->view('home/common/nav');?>
    <div class="container">
        <div class="row">
          <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">登录</h3>
                    </div>
                    <div class="panel-body">
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
                </div>
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
<script language="javascript">
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
</body>
</html>
