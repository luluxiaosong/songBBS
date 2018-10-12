<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*我的设置*/
//安全秘钥
$config['encryption_key']='0558ff564237abb96922b31e624c2f30';
//审核 off为关闭，on为开启
$config['is_approve']='off';
//网站运行状态
$config['site_close'] = 'on';
//网站暂时关闭公告
$config['site_close_msg'] = '网站升级,暂时关闭';
//是否使用redis缓存 true开启  false关闭
$config['on_redis'] = true;
//每页显示帖子条数
$config['page_nums'] = 10;
//每页显示回复条数
$config['page_comments'] = 10;