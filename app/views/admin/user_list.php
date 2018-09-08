<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>基本设置</title>
<?php $this->load->view('admin/header.php');?>
<script src="<?php echo base_url('static/common/js/global.js')?>" ></script>
</head>
<body>
<!--插入导航  -->
<?php $this->load->view('admin/nav');?>
<div class="col-md-10">
      <div class="panel panel-default">
          <ol class="breadcrumb">
              <li><a href="<?php echo site_url('admin/login')?>">首页</a></li>
              <li class="active">用户列表</li>
          </ol>
        <div class="panel-body">
          <form action="<?php echo site_url('admin/user/user_find')?>" method="post" accept-charset="utf-8" class="form-inline">
            <input id="username" class="form-control" name="username" placeholder="用户昵称" type="text" />
            <button type="submit" name="commit" class="btn btn-default">搜索</button>
            </form>
            <br/>
            <table class='table table-hover table-condensed'>
                <tbody>
                  <?php foreach( $user_list as $v):?>
							<tr id='user_<?php echo $v['uid']?>'>
									<td><?php echo $v['uid']?></td>
                                    <td><strong><a href="<?php echo site_url('user/user_home/'.$v['uid']) ?>" class="black startbbs profile_link" title="admin"><?php echo $v['username']?></a></strong>
									</td>
									<td><?php if($v['user_type'] == 1) echo '管理员'; else echo '普通用户'?>
									</td>
									<td><?php echo $v['email']?></td>
									<td class='center'>
                  <?php if($v['user_type'] != 1):?>  <a href="<?php echo site_url('admin/user/del/'.$v['uid'])?>" class="btn btn-sm btn-danger">删除</a><?php endif ?>
									</td>
								</tr>
              <?php endforeach;?>
				 </tbody>
            </table>
          </div>
        </div>
    </div><!-- /.col-md-8 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</body>