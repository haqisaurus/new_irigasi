<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Water extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->template['nav'] = $this->load->view('backend/part/nav-admin', 0, true);
		$this->template['popup'] = $this->load->view('backend/pages/region/popup', 0, true);

		// using model
		$this->load->model('water_model');
		$this->load->model('region_model');
	}

	public function index($offset = null)
	{
		checkUser(array(1));

		$data = array();
		$offset = $offset ?  $this->uri->segment(2) : 0;

		$data['table'] = $this->water_model->findWithRegion(array(), $this->limit, $offset)->result();
		$data['pagination'] = $this->pagination();

		$this->template['content'] = $this->load->view('backend/pages/water/view', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function create()
	{
		checkUser(array(1));

		$data = array();
		$data['region'] = $this->region_model->find()->result();
		$this->template['content'] = $this->load->view('backend/pages/water/create', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function doCreate()
	{
		checkUser(array(1));
		$regionID = $this->input->post('region-id');
		$date = $this->input->post('date');
		$left = $this->input->post('left');
		$right = $this->input->post('right');
		$limpas = $this->input->post('limpas');
		

		$this->form_validation->set_rules('region-id', 'Nama daerah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('left', 'Kanan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('right', 'Kiri', 'trim|required|xss_clean');
		$this->form_validation->set_rules('limpas', 'Limpas', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$data['region'] = $this->region_model->find()->result();
			$this->template['content'] = $this->load->view('backend/pages/water/create', $data, true);
			$this->load->view('backend/master', $this->template);
		}
		else
		{
			$data = array(
				'region_id' => $regionID,
				'date' => $date,
				'left' => $left,
				'right' => $right,
				'limpas' => $limpas,
				);

			$result = $this->water_model->insert($data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil dimasukan');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('water');
		}

	}

	public function update($id)
	{
		checkUser(array(1));

		$data = array();
		$data['region'] = $this->region_model->find()->result();
		$data['update'] = $this->water_model->findWithRegion(array('water.id' => $id), 1, 0)->row();
		$this->template['content'] = $this->load->view('backend/pages/water/update', $data, true);
		$this->load->view('backend/master', $this->template);
	}

	public function doUpdate()
	{
		$id = $this->input->post('id');
		$regionID = $this->input->post('region-id');
		$date = $this->input->post('date');
		$left = $this->input->post('left');
		$right = $this->input->post('right');
		$limpas = $this->input->post('limpas');
		

		$this->form_validation->set_rules('region-id', 'Nama daerah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('left', 'Kanan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('right', 'Kiri', 'trim|required|xss_clean');
		$this->form_validation->set_rules('limpas', 'Limpas', 'trim|required|xss_clean');


		if($this->form_validation->run() == FALSE)
		{
		    //Field validation failed.  User redirected to login page
			$data = array();
			$data['update'] = $this->water_model->find(array('water.id' => $id))->row();
			$this->template['content'] = $this->load->view('backend/pages/water/update', $data, true);
			$this->load->view('backend/master', $this->template);
		}
		else
		{
			$data = array(
				'region_id' => $regionID,
				'date' => $date,
				'left' => $left,
				'right' => $right,
				'limpas' => $limpas,
				);


			$result = $this->water_model->update(array('water.id' => $id), $data);

			if ($result['status']) {
				$message = array('status' => 1, 'data' => $result['id'], 'msg' => 'Data berhasil diperbarui');
			} else {
				$message = array('status' => 0, 'data' => '', 'msg' => 'Terdapat kesalahan');
			}
        	
        	$this->session->set_flashdata('message', $message);

			redirect('water');
		}

	}

	public function delete($id)
	{
		$result = $this->water_model->delete(array('water.id' => $id));

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
		
		$config['base_url'] = site_url('water');
		$config['total_rows'] = $this->water_model->find()->num_rows();
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