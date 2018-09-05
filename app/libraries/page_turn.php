<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//分页类
class Page_turn{

   public $pages_count;  //总页数
   public $rows;  //总记录条数
   public $per_page;  //每页条数
   public $url;
   public $page_now; //当前页数
   public $position; //描点
    function __construct($config)
   {
       $this->rows = $config['rows'];
       $this->per_page = $config['per_page'];
       //判断是否含?符号 没有则加？ 有则加&
       if(strpos($config['url'],'?')){
           $this->url = $config['url']."&";
       }else{
           $this->url = $config['url']."?";
       }

       if(!empty($config['position'])){
           $this->position = $config['position'];
       }

       $this->page_now = $config['page'];
       //计算总页数 总记录数除以每页条数 向上取整
       $this->pages_count = ceil($this->rows/$this->per_page);
   }
   //计算偏移
    public function left()
    {
        return ($this->page_now - 1) * $this->per_page;
    }
   //生成链接
   public function page_link()
   {
       //css样式
       $css =<<<EOD
         <style> 
         .page_link_div a{
         margin-right: 16px;
         border: 1px solid #ccc;
         padding: 6px 8px 6px 8px  ;
         background-color:#eee;
         color:#46748a  ;
         font-size: 14px;
         }
         .page_link_div span{
         margin-right: 16px;
         }
         .page_link_div{
         line-height: 28px;
         margin: 20px 0 30px 0;
         text-align: center;
         }
         .page_link_div a:hover{
         background-color: #03a9f4;
         color:white  ;
         }
        .page_now{
         background-color: #03a9f4 !important;
         color:white !important;
         }
         
         </style>
EOD;
       $div1= "<div class='page_link_div'>";
       $div2 = '</div>';
       //首页
       $home_link='';
       if($this->pages_count > 1) {
           $home_link = <<<EOD
<a href="{$this->url}page=1{$this->position}">首页</a>
EOD;
       }
       //末页
       $last_link='';
       if($this->pages_count>1) {
           $last_link = <<<EOD
<a href="{$this->url}page={$this->pages_count}{$this->position}">末页</a>
EOD;
       }
       //上一页
       $page_pre = $this->page_now-1;
       $page_pre_link = '';
       if($page_pre > 0) {
           $page_pre_link = <<<EOD
<a href="{$this->url}page=$page_pre{$this->position}">上一页</a>
EOD;
       }

       //下一页
       $page_next = $this->page_now+1;
       $page_next_link='';
       if($page_next <= $this->pages_count) {
           $page_next_link = <<<EOD
<a href="{$this->url}page=$page_next{$this->position}">下一页</a>
EOD;
       }


       //生成当前页的前三个页码 左边
       $link_left='';
       for($i = 3; $i>0; $i--) {
           $page1  = $this->page_now - $i;
           if ($page1 > 0) {
               $link_left .= <<<EOD
<a href="{$this->url}page=$page1{$this->position}">$page1</a>
EOD;
           }
       }
       //生成当前页的右3个页码
       $link_right='';
       $page2 = $this->page_now;
       for($i = 1; $i<4; $i++) {
           $page2 =$this->page_now + $i;
              if($page2 <= $this->pages_count){
                  $link_right.= <<<EOD
<a href="{$this->url}page=$page2{$this->position}">$page2</a>
EOD;
              }
       }
       //当前页
       $page_now_link = '';
       if($this->pages_count > 1) {
           $page_now_link = "<a class='page_now'>$this->page_now</a>";
       }
       //总数
       $rows_html =<<<EOD
<span>共{$this->pages_count}页，{$this->rows}条记录</span>
EOD;

       //拼接
       $page_link = $css.$div1.$page_pre_link.$home_link.$link_left.$page_now_link.$link_right.$last_link.$page_next_link.$rows_html.$div2;

       return $page_link;
   }

}