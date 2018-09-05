<div class="navbar navbar-default ">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" style="color: black" href="<?php echo site_url('admin/index'); ?>">管理后台</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url('home'); ?>" target=_blank>前台</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="javascript:">当前用户: <?php echo $_SESSION['username']; ?></a></li>
                <li><a href="<?php echo site_url('admin/user/out'); ?>">退出</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<div class="container" style="margin-left:10px">
    <div class="row">
        <div class="col-md-2">
            <div class="list-group">
                <a href="" class="list-group-item disabled"> 选项</a>
                <a href="<?php echo site_url('admin/index') ?>" class="list-group-item">首页</a>
                <a href="<?php echo site_url('admin/set/base_set') ?>" class="list-group-item">基本设置</a>
                <a href="<?php echo site_url('admin/user/user_list') ?>" class="list-group-item">用户列表</a>
                <a href="<?php echo site_url('admin/topic/topic_list') ?>" class="list-group-item">话题列表</a>
                <a href="<?php echo site_url('admin/topic/topic_add') ?>" class="list-group-item">话题添加</a>
                <a href="<?php echo site_url('admin/set/cache_del_all') ?>" class="list-group-item">清空本地缓存</a>
            </div>
        </div>
