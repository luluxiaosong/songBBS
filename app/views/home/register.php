<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>注册新用户--社区</title>
    <?php $this->load->view('home/common/header');?>
</head>
<body>
<?php $this->load->view('home/common/nav')?>

<style>

</style>
<script >
    //刷新验证图片
    function reloadVcode() {
        $("#vcodeImg").attr('src', '<?php echo site_url('vcode_C/get?');?>'+Math.random());
    }
    //格式验证 ajax注册
    $(function () {
        $(".register_post").click(function () {
            var username = $("#username").val().trim();
            var username_status = false;
            var email = $("#email").val().trim();
            var email_status = false;
            var password = $("#password").val().trim();
            var password_status = false;
            var password_confirm = $("#password_confirm").val().trim();
            var password_confirm_status = false;
            var vcode = $("#vcode").val().trim();
            var vcode_status = false;
            //用户名 中文或字母 2~8位数 先检查格式 再检查数据库
            var username_re = /^[a-zA-Z\u4e00-\u9fa5]+$/;
            if(username.length <= 8 && username.length >= 2 && username.match(username_re)){
                //检测用户名是否可用ajax
                $.ajax({
                    url: "<?php echo site_url('user/check_username')?>",
                    data: {username: username},
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
            if(email_re.test(email)){
                //判断邮箱是否已经被注册 ajax
              $.ajax({
                  url: "<?php echo site_url('user/check_email')?>",
                  async: false,
                  data: {email: email},
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
            if(password.length >=6 && password.length <= 16 && password_re.test(password)){
                password_status = true;
                $(".password_tips").text("OK");
                $(".password_tips").css("color","#3c763d");
            }else{
                $(".password_tips").text("密码格式为字母加数字，6~12位");
                $(".password_tips").css("color","red");
            }
            //两次输入密码确认
            if(password_confirm.length >= 6 && password_confirm === password){
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
                data: {vcode: vcode},
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
                $.post(
                    "<?php echo site_url('user/register') ?>",
                    {username: username, password: password, password_confirm: password_confirm, email: email, vcode: vcode},
                    function (msg) {
                        if (msg == "yes") {
                            confirm("注册成功, 立即登陆");
                            location.href = "<?php echo site_url('user/login')?>";
                        }else{
                            alert('未知错误'+msg);
                        }
                    },
                )
            }else{
                $(".post_tips").text("请检查输入");
            }
        })
    })
</script>
</body>
</html>