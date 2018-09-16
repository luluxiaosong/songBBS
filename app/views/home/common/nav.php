
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
                <li><a href="<?php echo site_url('user/register') ?>""> 注册</a></li>
                <li><a href="<?php echo site_url('user/login') ?>"  >登录</a></li>
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
                    console.log(msg);
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
</script>