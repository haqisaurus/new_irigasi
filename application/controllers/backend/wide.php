<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wide extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->template['nav'] = $this->load->view('backend/part/nav-admin', 0, true);
		$this->template['popup'] = $this->load->view('backend/pages/region/popup', 0, true);

		// using model
		$this->load->model('wide_model');
		$this->load->model('region_model');
	}

	public function index($offset = null)
	{
		checkUser(1);

		$data = array();
		$offset = $offset ?  $this->uri->segment(2) : 0;

		$data['table'] = $this->wide_model->findWithRegion(array(), $this->limit, $offset)->result();
		$data['pagination'] = $this->pagination();

		$this->template['content'] = $this->load->view('backend/pages/wide/view', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function create()
	{
		checkUser(1);

		$data = array();
		$data['region'] = $this->region_model->find()->result();
		$this->template['content'] = $this->load->view('backend/pages/wide/create', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function doCreate()
	{
		checkUser(1);
		$regionID = $this->input->post('region-id');
		$location = $this->input->post('wide-location');
		$wide = $this->input->post('wide');
		

		$this->form_validation->set_rules('region-id', 'Nama daerah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('wide-location', 'Nama lokasi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('wide', 'Luas daerah', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$data['region'] = $this->region_model->find()->result();
			$this->template['content'] = $this->load->view('backend/pages/wide/create', $data, true);
			$this->load->view('backend/master', $this->template);
		}
		else
		{
			$data = array(
				'region_id' => $regionID,
				'wide' => $wide,
				'area_name' => $location,
				);

			$result = $this->wide_model->insert($data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil dimasukan');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('wide');
		}

	}

	public function update($id)
	{
		checkUser(1);

		$data = array();
		$data['region'] = $this->region_model->find()->result();
		$data['update'] = $this->wide_model->findWithRegion(array('wide.id' => $id), 1, 0)->row();
		$this->template['content'] = $this->load->view('backend/pages/wide/update', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function doUpdate()
	{
		$id = $this->input->post('id');
		$regionID = $this->input->post('region-id');
		$location = $this->input->post('wide-location');
		$wide = $this->input->post('wide');

		$this->form_validation->set_rules('region-id', 'Nama daerah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('wide-location', 'Nama lokasi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('wide', 'Luas daerah', 'trim|required|xss_clean');


		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$data['update'] = $this->wide_model->find(array('wide.id' => $id))->row();
			$this->template['content'] = $this->load->view('backend/pages/user/update', $data, true);
			$this->load->view('backend/master', $this->template);
		}
		else
		{
			$data = array(
				'region_id' => $regionID,
				'wide' => $wide,
				'area_name' => $location,
				);


			$result = $this->wide_model->update(array('wide.id' => $id), $data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil diperbarui');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('wide');
		}

	}

	public function delete($id)
	{
		$result = $this->wide_model->delete(array('wide.id' => $id));

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
		$config['total_rows'] = $this->wide_model->find()->num_rows();
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