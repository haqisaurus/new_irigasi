<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guest_page extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function index()
	{
		$this->load->library('irigasi/wide');
		$data['regions'] 		= $this->wide->getAllWide();

		$template['content'] = $this->load->view('frontend/pages/home', $data, true); 
		$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
		$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
		$this->load->view('frontend/master', $template);
		
		$this->load->library('user_agent');

		if ($this->agent->is_mobile()) {
			redirect('login');
		}
	}
	
}