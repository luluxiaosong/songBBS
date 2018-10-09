<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>话题修改</title>
    <?php $this->load->view('admin/header.php');?>
</head>
<body>
<!--插入导航  -->
<?php $this->load->view('admin/nav');?>
<div class="col-md-10">
    <div class="panel panel-default">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/login')?>">首页</a></li>
            <li ><a href="<?php echo site_url('admin/topic') ?>">话题列表</a></li>
            <li class="active">话题添加</li>
        </ol>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('admin/topic/topic_add')?>" method="post">

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">父类</label>
                    <div class="col-sm-2">
                        <select name="topic_pid" class="form-control">
                            <option value="0">顶级分类</option>
                            <?php foreach ($topics as $v):?>
                            <option value="<?php echo $v['topic_id']?>"><?php echo $v['topic_name'] ?></option>
                            <?php endforeach?>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">名称</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="topic_name" value="<?php echo @$topic['topic_name']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label" >简介</label>
                    <div class="col-sm-6">
                        <textarea  class="form-control" name="content"><?php echo @$topic['content']?></textarea>
                    </div>
                </div>

                <br/>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ico</label>
                    <input type="file" name="userfile">
                </div>
                <br/>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">创建</button>
                    </div>
                </div>
            </form>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
</div><!-- /.col-md-8 -->
<footer>
    <div class="container">
        <div class="row">
        </div>
    </div>
</footer>
</body>
</html>
