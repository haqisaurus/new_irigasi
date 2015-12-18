<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Juru_page extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function index()
	{
		$template['content'] 	= $this->load->view('integrated/pages/admin/dashboard', '', true); 
		$this->load->view('integrated/master', $template);
	}
}