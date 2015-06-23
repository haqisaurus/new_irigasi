<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $template = array();

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->template['nav'] = $this->load->view('backend/part/nav-admin', 0, true);

		// using model
	}

	public function index()
	{
		$data = array();
		$this->template['content'] = $this->load->view('backend/pages/landing', $data, true);
		$this->load->view('backend/master', $this->template);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */