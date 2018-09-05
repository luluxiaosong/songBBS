<?php if(!defined('BASEPATH')) exit('No direct acces script allowed');

class stat extends CI_Model{
 //注意site_stats是竖表
	public function stats_info(){
		$query=$this->db->get('site_stats');

		if($query->num_rows()>0){
			$data = $query->result_array();
		}

  foreach($data as $k=>$v){
  		$data_1[$v['item']]=$v['value'];
  }

 		return $data_1;
	}

	//后台统计数据: 今日发帖posts_today，今日注册registers_today，今日评论comments_today,会员总数users,帖子总数posts,评论总数comments
	public function totels_admin()
	{
		// $totels['posts_today']
		// $totels['registers_today']
		// $totels['comments_today']
		// $totels['posts']
		// $totels['registers']
		// $totels['comments']
		$res = $this->db->select(count('*'))->get('posts')->row_array();
   var_dump($res);

	}

}
