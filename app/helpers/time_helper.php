<?php
//与时间相关函数
    /*@距离当前时间的差
    小于一小时 输出多少分钟前
    1小时到24小时 输出多少小时前
    大于24小时 输出多少天前

    */

function wordTime($time) {
    $time = (int) substr($time, 0, 10);
    $int = time() - $time;
    $str = '';
    if ($int <= 2){
        $str = sprintf('刚刚', $int);
    }elseif ($int < 60){
        $str = sprintf('%d秒前', $int);
    }elseif ($int < 3600){
        $str = sprintf('%d分钟前', floor($int / 60));
    }elseif ($int < 86400){
        $str = sprintf('%d小时前', floor($int / 3600));
    }else{
        $str = sprintf('%d天前', floor($int / 86400));

    }
    return $str;
}