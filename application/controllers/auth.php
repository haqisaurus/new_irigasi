<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	var $template = array();

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->template['popup'] = $this->load->view('integrated/pages/auth/popup', 0, true);

		// using library
		$this->load->library('irigasi/user');
		$this->load->library('form_validation');
	}

	
	/*================== logging ==============================*/
	public function login()
	{

		if ($this->session->userdata('logged_in')) {
			$this->redirectUser();
		} else {
			$data = array();

			$this->load->view('integrated/pages/auth/login');
		}
	}

	public function doLogin()
	{

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$this->session->set_flashdata('error', validation_errors());
			$this->load->view('integrated/pages/auth/login');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$remember = $this->input->post('rememeber');

			$loginResult = $this->user->authentication($username, $password, $remember);
			if ($loginResult) {
				// redirect user 
				$this->redirectUser();
			} else {
				redirect('login');
			}
	     	//Go to private area
			
		}
	}

	private function redirectUser()
	{
		$userData = $this->session->userdata('logged_in');
		switch ($userData['role_id']) {
			case 1:
				redirect('/admin');
				break;
			case 2:
				# code...
				break;
			case 3:
				# code...
				break;
			case 4:
				# code...
				break;
			
			default:
				# code...
				break;
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