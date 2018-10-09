<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>提示信息</title>
    <link href="css/bootstrap.min_5.css" media="screen" rel="stylesheet" type="text/css" />
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
    <h2>提示信息</h2>
    <div class="alert alert-danger" role="alert">
        <?php echo $content?>
    </div>
    <p>
        <a href="<?php echo $url?>" class="alert-link">如果您的浏览器没有自动跳转，请点击这里</a>
        <script language="javascript">setTimeout(function(){location:"<?php echo $url?>";}, 1400);</script>
    </p>

</div>
</body>
</html>