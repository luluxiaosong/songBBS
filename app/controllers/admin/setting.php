<?php if( ! defined('BASEPATH')) die('No direct script access allowed');

class Setting extends Admin_Controller{

  function __construct(){
    parent::__construct();
  }
 /*进入基本设置页面*/
  function base()
  {

     $this->load->view('admin/set');
  }

  //网站设定
  function site_set()
  {
  }


}
