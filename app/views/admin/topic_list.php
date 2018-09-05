<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>话题列表</title>
    <?php $this->load->view('admin/header.php');?>
</head>
<body>
<!--插入导航  -->
<?php $this->load->view('admin/nav');?>
<div class="col-md-10">
    <div class="panel panel-default">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/login')?>">首页</a></li>
                <li class="active">话题列表</li>
            </ol>
        <div class="panel-body">
        <table class="table table-hover table-condensed">
                <?php if(!empty($topics)) foreach($topics as $v):?>

                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<span>&nbsp;</span> <?php echo $v['topic_name'];?></td>
                    <td><span class="pull-right"><a
                            href="<?php echo site_url('admin/topic/topic_reset/'.$v['topic_id']) ?>" class="btn btn-primary btn-sm"">修改</a>
  							<a href="<?php echo site_url('admin/topic/del/'.$v['topic_id'])?>" class="btn btn-sm btn-danger">删除</a></span>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
</div><!-- /.col-md-8 -->
</div><!-- /.row -->
</div><!-- /.container -->
<footer>
    <div class="container">
        <div class="row">
        </div>
    </div>
</footer>
</body>
</html>
