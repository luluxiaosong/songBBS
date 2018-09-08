<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜索-MyBBS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?php $this->load->view('home/common/header')?>
</head>
<body>
<!--导航头-->
<?php $this->load->view('home/common/nav')?>
<!--主框 -->
 <div  style="margin: auto; padding:12px 20px 30px 12px; width: 70%; height: auto; background-color: #FEFEFE;  border-radius: 4px;">
       <div style="width: 75%">
            <h4  style="margin-top: 10px; padding-bottom: 6px; border-bottom: #cccccc 1px solid">&nbsp;搜索结果 </h4>
            <ul>
                <?php $this->load->view('home/common/post_list') ?>
            </ul>
        </div>
</div>
</body>
</html>
