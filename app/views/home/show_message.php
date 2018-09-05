<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<title>提示</title>
<?php $this->load->view('home/common/head_meta');?>
<style type="text/css">
#container {
	width:600px;
	margin: 10px auto;
	padding: 20px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}
</style>
</head>
<body>
	<div id="container">
			<div class="alert<?php if (@$res=='成功'){ ?> alert-success<?php }else{?> alert-danger<?php } ?>" role="alert">
			<?php echo $message;?>
			</div>
		    <p>
			<?php if(!$url){ ?>
			<a href="javascript:history.back();" class="alert-link">如果您的浏览器没有自动跳转，请点击这里</a>
			<script>setTimeout(function(){history.back();},3000);</script>
			<?php } else{?>
			<a href="<?php echo $url?>" class="alert-link">如果您的浏览器没有自动跳转，请点击这里</a>
			<script>setTimeout("location.href='<?php echo $url;?>';",3000);</script>   
			<?php } ?>
			</p>
		
	</div>
</body>
</html>