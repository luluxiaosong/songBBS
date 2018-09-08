<?php $this->load->view('admin/header.php');?>
<body>
<!--导航  -->
<?php $this->load->view('admin/nav.php');?>
<div class="col-md-8">
    <div class="panel panel-default">
            <ol class="breadcrumb">
                <li class="active">首页</li>
            </ol>
        <div class="panel-body">
            <div class="col-md-8">
                <ul>
                    <li>今日发贴：<?php echo $totel['posts_today']?></li>
                    <li>今日回复：<?php echo $totel['comments_today']?></li>
                    <li>今日注册：<?php echo $totel['users_today']?></li>
                    <li>总用户数：<?php echo $totel['users']?></li>
                    <li>总贴子数：<?php echo $totel['posts']?></li>
                    <li>总回复数：<?php echo $totel['comments']?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<footer>
</footer>
</body>
</html>
