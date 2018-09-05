<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会员--</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?php $this->load->view('home/common/header')?>
</head>
<body>
<!--导航头-->
<?php $this->load->view('home/common/nav')?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-9">
            <div class="panel">
                <?php foreach($users as $v) :?>
                <a href="<?php echo site_url('user/user_home/'.$v['uid'])?>" target="_blank" style="float: left; margin: 5px 8px 5px 8px; padding: 8px; border: 1px solid #c0e7ff">
                    <img src="<?php echo $v['avatar']?>" style="width: 40px; height: 40px; margin-right: 8px;">
                    <span style="font-size: 18px;"><?php echo $v['username']?></span>
                </a>
                <?php endforeach?>
                <div class="clearfix"></div>
            </div>

        </div>


    </div>
</div>
</body>
</html>
