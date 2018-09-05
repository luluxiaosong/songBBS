<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Follow extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
	}

	public function index()
	{
		if(empty($_SESSION['uid'])){
			redirect('user/login_html');
		}
		$uid= $_SESSION['uid'];
		$this->load->view('home/follow');

	}
}