<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Region extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->template['nav'] = $this->load->view('backend/part/nav-admin', 0, true);
		$this->template['popup'] = $this->load->view('backend/pages/region/popup', 0, true);

		// using model
		$this->load->model('region_model');
	}

	public function index($offset = null)
	{
		checkUser(1);

		$data = array();
		$offset = $offset ?  $this->uri->segment(2) : 0;

		$data['table'] = $this->region_model->find(array(), $this->limit, $offset)->result();
		$data['pagination'] = $this->pagination();

		$this->template['content'] = $this->load->view('backend/pages/region/view', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function create()
	{
		checkUser(1);

		$data = array();

		$this->template['content'] = $this->load->view('backend/pages/region/create', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function doCreate()
	{
		checkUser(1);
		$regionName = $this->input->post('region-name');
		

		$this->form_validation->set_rules('region-name', 'Nama daerah', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$this->template['content'] = $this->load->view('backend/pages/region/create', $data, true);
			$this->load->view('backend/master', $this->template);
		}
		else
		{
			$data = array(
				'region_name' => $regionName,
				);

			$result = $this->region_model->insert($data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil dimasukan');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('region');
		}

	}

	public function update($id)
	{
		checkUser(1);

		$data = array();
		$data['update'] = $this->region_model->find(array('region.id' => $id))->row();
		$this->template['content'] = $this->load->view('backend/pages/region/update', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function doUpdate()
	{
		$id = $this->input->post('id');
		$regionName = $this->input->post('region-name');

		$this->form_validation->set_rules('region-name', 'Region name', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$data['update'] = $this->region_model->find(array('region.id' => $id))->row();
			$this->template['content'] = $this->load->view('backend/pages/user/update', $data, true);
			$this->load->view('backend/master', $this->template);
		}
		else
		{
			$data = array(
				'region_name' => $regionName,
				);

			$result = $this->region_model->update(array('region.id' => $id), $data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil diperbarui');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('region');
		}

	}

	public function delete($id)
	{
		$result = $this->region_model->delete(array('region.id' => $id));

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
		
		$config['base_url'] = site_url('region');
		$config['total_rows'] = $this->region_model->find()->num_rows();
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */