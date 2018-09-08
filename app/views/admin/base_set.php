<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>基本设置</title>
	<?php $this->load->view('admin/header.php');?>
</head>
<body >
<!--插入导航  -->
<?php $this->load->view('admin/nav.php');?>
  <div class="col-md-10">
          <div class="panel panel-default">
  			      <ol class="breadcrumb">
  						  <li><a href="<?php echo site_url('admin/login')?>">首页</a></li>
  						  <li class="active">基本设置</li>
  						</ol>
              <div class="panel-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane in active" id="tab1">
							<form accept-charset="UTF-8" action="<?php echo site_url('admin/set/base_set')?>" class="form-horizontal" method="post">
							<div class='form-group'>
							<label class="col-md-3 control-label" for="site_close">网站运行状态</label>
							<div class='col-md-5'>
							<label class='radio-inline'>
							<input checked="checked" name="site_status" type="radio" value="1" <?php if($base_set['site_status'] == 1) echo 'checked'?>/>开启站点</label>

							<label class='radio-inline'>
							<input  name="site_status" type="radio" value="0" <?php if($base_set['site_status'] == 0) echo 'checked'?>/>关闭站点</label>
							</div>
							</div>
							<div class='form-group'>
							<label class="col-md-3 control-label" for="settings_site_close_msg">网站关闭公告</label>
							<div class='col-md-5'>
							<textarea class="form-control" id="settings_site_close_msg" name="close_message" rows="5"><?php echo $base_set['close_message'] ?></textarea>
							</div>
							</div>
							<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
							  <button type="submit" name="commit" class="btn btn-primary">保存</button>
							</div>
							</div>
							</form>
						</div>
                    </div>
                </div>
            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</body>
</html>
