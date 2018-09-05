<?php
$mod = php_sapi_name();
echo $mod;
?>
<html>
<div style="width: 200px; height: 200px; background-color:green"  onclick="javascrit:a()">测试js代码是否能嵌入html标签</div>
<a href="javascript:alert('链接嵌入');alert('链接嵌入');">测试链接</a>
</html>
<script>
 function a() {
     alert("标准写法");
 }
</script>