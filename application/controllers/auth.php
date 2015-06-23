<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	var $template = array();

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->template['nav'] = $this->load->view('backend/part/nav-admin', 0, true);
		$this->template['popup'] = $this->load->view('backend/pages/user/popup', 0, true);

		// using model
		$this->load->model('user_model');
	}

	
	/*================== logging ==============================*/
	public function login()
	{


	}
	public function doLogin()
	{
		//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_checkDatabase');

		if($this->form_validation->run() == FALSE)
		{
	     //Field validation failed.  User redirected to login page
			echo validation_errors();
		}
		else
		{
	     	//Go to private area
			redirect('dashboard');
		}
	}

	function checkDatabase($password)
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->user_model->login($username, $password);

		if($result)
		{
			$this->session->set_userdata('logged_in', $result);
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}

	public function register()
	{
		
	}

	public function doRegister()
	{
		
	}

	public function doLogout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('/');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */