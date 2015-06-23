<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->template['nav'] = $this->load->view('backend/part/nav-admin', 0, true);
		$this->template['popup'] = $this->load->view('backend/pages/user/popup', 0, true);

		// using model
		$this->load->model('user_model');
		$this->load->model('role_model');
	}

	public function index($offset = null)
	{
		checkUser(1);

		$data = array();
		$offset = $offset ?  $this->uri->segment(2) : 0;

		$data['table'] = $this->user_model->find(array(), $this->limit, $offset)->result();
		$data['pagination'] = $this->pagination();

		$this->template['content'] = $this->load->view('backend/pages/user/view', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function create()
	{
		checkUser(1);

		$data = array();

		$this->template['content'] = $this->load->view('backend/pages/user/create', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function doCreate()
	{
		checkUser(1);
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$firstName = $this->input->post('first_name');
		$lastName = $this->input->post('last_name');
		$roleID = $this->input->post('role_id');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('first_name', 'Nama depan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Nama belakang', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$this->template['content'] = $this->load->view('backend/pages/user/create', $data, true);
			$this->load->view('backend/master', $this->template);
		}
		else
		{
			$data = array(
				'username' => $username,
				'password' => md5($password),
				'first_name' => $firstName,
				'last_name' => $lastName,
				'role_id' => $roleID 
				);

			$result = $this->user_model->insert($data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil dimasukan');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('user');
		}

	}

	public function update($id)
	{
		checkUser(1);

		$data = array();
		$data['update'] = $this->user_model->find(array('user.id' => $id))->row();
		$this->template['content'] = $this->load->view('backend/pages/user/update', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function doUpdate()
	{
		$id = $this->input->post('id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$firstName = $this->input->post('first_name');
		$lastName = $this->input->post('last_name');
		$roleID = $this->input->post('role_id');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('first_name', 'Nama depan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Nama belakang', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$data['update'] = $this->user_model->find(array('user.id' => $id))->row();
			$this->template['content'] = $this->load->view('backend/pages/user/update', $data, true);
			$this->load->view('backend/master', $this->template);
		}
		else
		{
			$data = array(
				'username' => $username,
				'first_name' => $firstName,
				'last_name' => $lastName,
				'role_id' => $roleID 
				);

			($password) ? $data['password'] = md5($password) : '' ;

			$result = $this->user_model->update(array('user.id' => $id), $data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil diperbarui');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('user');
		}

	}

	public function delete($id)
	{exit();
		$result = $this->user_model->delete(array('user.id' => $id));

		if ($result['status']) {
			$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil dihapus');
		} else {
			$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
		}
    	
    	$this->session->set_flashdata('message', $message);

		redirect('user');
	}

	public function pagination()
	{
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('user');
		$config['total_rows'] = $this->user_model->find()->num_rows();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 2;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		return $this->pagination->create_links();
	}

	/*=================== ajax requst =========================*/
	public function ajaxDeleteAll()
	{
		
	}
	/*================== showing page =========================*/
	public function role()
	{
		checkUser(1);

		$data = array();
		$data['table'] = $this->role_model->find()->result();
		$this->template['content'] = $this->load->view('backend/pages/role/view', $data, true);
		$this->load->view('backend/master', $this->template);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */