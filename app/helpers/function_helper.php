<?php
//基本函数 全局加载

    /*返回信息 第三个参数为1时是成功信息，为2是失败信息*/
    function show_message($message = '', $url = '', $status = 2, $heading = '提示信息', $time = 1400)
    {
        include APPPATH . 'errors/show_message.php';
        exit;
    }
    //断点 原格式查看变量或数组、资源
    function p($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        exit();
    }
    //帖子内容摘要 过滤html标签 空格 截取50字
    function content_part($content)
    {
        //去掉html和php标签
        $content = strip_tags($content);
        //去掉全部空格
        $oldchar=array(" ","　","\t","\n","\r");
        $newchar=array("","","","","");
        $content = str_replace($oldchar,$newchar,$content);
        $content = mb_substr($content,0,32);
        $content .= '......';
        return $content;
    }
?>