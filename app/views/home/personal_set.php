<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<title>修改资料</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<?php $this->load->view('home/common/header');?>
</head>
<body>
<?php $this->load->view('home/common/nav');?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
            	<div><a href="<?php echo site_url('personal/home')?>" >个人主页</a> > 修改个人资料</div>
                <div class="panel">
                    <div class="panel-body">
                        <div class="setting">
							<form accept-charset="UTF-8" action="<?php echo site_url('personal/base_set')?>" class="form-horizontal" method="post">
								<div class="form-group">
									<label class="col-md-2 control-label" for="user_nickname">用户名</label>
									<div class="col-md-6">
									<input class="form-control" disabled="disabled" id="user_nickname" name="username" size="50" type="text" value="<?php echo $user['username']?>" />
                                    <span class="help-block red"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="user_account_attributes_introduction">个人简介</label>
									<div class="col-md-6">
									<textarea class="form-control" cols="40" id="user_account_attributes_introduction" name="introduction" rows="5"><?php echo $user['introduction']?></textarea>
									<span class="help-block red"></span>
									</div>
								</div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-6">
                                        <button type="submit" class="btn btn-primary">确认修改</button>
                                    </div>
                                </div>
	                            </form>
                        </div>
            <hr class="" />
			<div class="">
             <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo site_url('personal/avatar_set')?>" method="post">
			<input type="hidden" name="uid" value="<?php echo $user['uid']?>">
	  			<fieldset>
	    			<div class="form-group">
	      				<label class="col-md-2 control-label">当前头像</label>
	      				<div class="col-md-8">
	                            <img class="middle_avatar" src="<?php echo base_url($user['avatar'])?>"   style="height: 50px; width: 50px">
	      				</div>
	    			</div>
	    			<div class="form-group">
	      				<div class="col-md-2"></div>
	      				<div class="col-md-6">
	       					<input type="file" id="avatar_file" name="userfile" />
	      				</div>
	    			</div>
	    			<div class="form-group">
		    			<div class="col-sm-offset-2 col-sm-6">
	    				<button type="sumbmit" id="upload_img" name="upload" class="btn btn-primary">修改头像</button>
	    				</div>
	    			</div>
	    		</fieldset>
                    </form>
            </div>
        <hr/>

                    </div>
                </div>
            </div>
			
</div>
			</div> 
        </div>
    </div>

<footer class="small">
	<div class="container">
		<div class="row">
		</div>
	</div>
</footer>
</body>
</html>