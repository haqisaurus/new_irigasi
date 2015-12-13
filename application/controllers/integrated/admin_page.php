<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_page extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function index()
	{
		$template['content'] 	= $this->load->view('integrated/pages/admin/dashboard', '', true); 
		$this->load->view('integrated/master', $template);
	}

	// user section 
	public function viewUser($value='')
	{
		$this->load->library('irigasi/user');
		$data['table'] = $this->user->getAllUser();

		$template['content'] 	= $this->load->view('integrated/pages/admin/user/view', $data, true); 
		$template['popup'] 	= $this->load->view('integrated/pages/admin/user/popup', $data, true); 
		$this->load->view('integrated/master', $template);
	
	}

	public function createUser()
	{
		$template['content'] 	= $this->load->view('integrated/pages/admin/user/create', '', true); 
		$this->load->view('integrated/master', $template);
	}

	public function createUserAction()
	{
		$this->load->library('irigasi/user');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('first-name', 'Nama Depan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last-name', 'Nama Belakang', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to create page
			$this->session->set_flashdata('error', validation_errors());
			$template['content'] 	= $this->load->view('integrated/pages/admin/user/create', '', true); 
			$this->load->view('integrated/master', $template);
		}
		else
		{
			$dataInsert = array(
				'username' 		=> $this->input->post('username'),
				'password' 		=> md5($this->input->post('password')),
				'first_name'	=> $this->input->post('first-name'),
				'last_name'		=> $this->input->post('last-name'),
				'role_id' 		=> $this->input->post('role-id'),
				);

			$insertResult = $this->user->updateUser($dataInsert);

			if ($insertResult) {
				// redirect user 
				redirect('user');
			} else {
				redirect('login');
			}
	     	//Go to private area
			
		}
	}

	public function editUser($userID = 0)
	{
		$this->load->library('irigasi/user');
		$condition 				= array('user.id' => $userID);
		$data['user'] 			= $this->user->getSpecificUser($condition);
		
		$template['content'] 	= $this->load->view('integrated/pages/admin/user/update', $data, true); 
		$this->load->view('integrated/master', $template);
	}

	public function editUserAction()
	{
		$this->load->library('irigasi/user');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('first-name', 'Nama Depan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last-name', 'Nama Belakang', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to create page
			$this->session->set_flashdata('error', validation_errors());
			$template['content'] 	= $this->load->view('integrated/pages/admin/user/update', '', true); 
			$this->load->view('integrated/master', $template);
		}
		else
		{
			$password = $this->input->post('password');
			// avoid change password if password is empty
			if ($password) {
				$dataInsert = array(
					'id'			=> $this->input->post('id'),
					'username' 		=> $this->input->post('username'),
					'password' 		=> md5($this->input->post('password')),
					'first_name'	=> $this->input->post('first-name'),
					'last_name'		=> $this->input->post('last-name'),
					'role_id' 		=> $this->input->post('role-id'),
				);
			} else {
				$dataInsert = array(
					'id'			=> $this->input->post('id'),
					'username' 		=> $this->input->post('username'),
					'first_name'	=> $this->input->post('first-name'),
					'last_name'		=> $this->input->post('last-name'),
					'role_id' 		=> $this->input->post('role-id'),
				);
			}
			

			$insertResult = $this->user->updateUser($dataInsert);

			if ($insertResult) {
				// redirect user 
				redirect('user');
			} else {
				redirect('login');
			}
	     	//Go to private area
			
		}
	}

	public function deleteUser($userID='')
	{
		$this->load->library('irigasi/user');

		$result = $this->user->deleteUser($userID);

 		redirect('user');
	}
	// END : user section
}