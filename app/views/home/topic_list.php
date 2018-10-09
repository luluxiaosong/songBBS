<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>话题列表--我的社区</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?php $this->load->view('home/common/header')?>
</head>
<body>
<!--导航头-->
<?php $this->load->view('home/common/nav')?>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="width: 97%;">
            <div class="panel panel-body">
<?php foreach( $topics as $v ) :?>
     <?php if($v['topic_pid'] == 0 ):?>
     <h3 style="text-align: center; padding-top: 16px; padding-bottom: 10px;"><?php echo $v['topic_name']?></h3>
       <?php foreach ($topics as $vv):?>
        <?php if($vv['topic_pid'] == $v['topic_id']):?>
                <a  href="<?php echo site_url('topic/topic_show/'.$vv['topic_id'])?>" style="float: left; width: 250px; height: 130px;  padding: 8px ; margin: 8px; border: 1px #cccccc solid">
                    <div>
                        <img src="<?php echo base_url($vv['ico'])?>" style="width: 60px; height: 50px; border-radius: 6px; float: left; margin-right: 10px; margin-left: 2px"/>
                        <p style="padding-top: 12px; padding-bottom: 8px">
                            <span style="font-size: 16px;"> <?php echo $vv['topic_name'] ?></span>
                        </p>
                            <div class="clearfix"></div>
                    </div>
                    <div style="color: black; font-size: 10px; padding-top: 12px;"><?php echo $vv['content']?></div>
                </a>
        <?php endif ?>
       <?php endforeach?>
                <div class="clearfix"></div>
     <?php endif?>
<?php endforeach; ?>
                <div class="clearfix"></div>
        </div>
    </div>
</div>
</body>
</html>
