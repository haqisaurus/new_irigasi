<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Juru_page extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function __construct()
	{
		parent::__construct();
		
		checkUser(array(2));
	}

	public function index()
	{
		$this->load->library('user_agent');
			

		if ($this->agent->is_mobile()) {
			$this->load->view('mobile/mobile-view', '');
		} else {
			$template['content'] 	= $this->load->view('integrated/pages/admin/dashboard', '', true); 
			$this->load->view('integrated/master', $template);
		}

	}

	// water section =====================================================================================
		public function viewWater()
		{
			
			$year 		= $this->input->post('year');
			$month 		= $this->input->post('month');
			$regionID 	= $this->input->post('region-id');

			$this->form_validation->set_rules('year', 'Tahun', 'trim|xss_clean');
			$this->form_validation->set_rules('month', 'Bulan', 'trim|xss_clean');
			$this->form_validation->run();

			$this->load->library('irigasi/water');

			$data['table'] = array();
			$data['years'] = $this->water->getAllYear();
			if ($_POST) {
				$condition 		= array();
				$conditionLike  = array('date' => $year . '-' . $month);
				$data['table'] 	= $this->water->getAllWater($condition, $conditionLike);
				
			}
			
			$template['content'] 	= $this->load->view('integrated/pages/admin/water/view', $data, true);
			$template['popup'] 		= $this->load->view('integrated/pages/admin/water/popup', '', true); 
			$this->load->view('integrated/master', $template);
		}

		public function createWater()
		{
			$this->load->library('irigasi/region');
			$data['regions'] 		= $this->region->getAllRegion();

			$template['content'] 	= $this->load->view('integrated/pages/admin/water/create', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function createWaterAction()
		{
			$this->load->library('irigasi/region');
			$this->load->library('irigasi/water');

			$this->form_validation->set_rules('region-id', 'Region', 'trim|required|xss_clean');
			$this->form_validation->set_rules('date', 'Tanggal', 'trim|required|xss_clean');
			$this->form_validation->set_rules('right', 'Debit kanan', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_rules('left', 'Debit kiri', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_rules('limpas', 'Debit limpas', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if($this->form_validation->run() == FALSE)
			{
			    //Field validation failed.  User redirected to create page
				$this->session->set_flashdata('error', validation_errors());
				$data['regions'] 		= $this->region->getAllRegion();
				$template['content'] 	= $this->load->view('integrated/pages/admin/water/create', $data, true); 
				$this->load->view('integrated/master', $template);
			}
			else
			{
				$dataInsert = array(
					'region_id' 	=> $this->input->post('region-id'),
					'date' 			=> $this->input->post('date'),
					'right' 		=> $this->input->post('right'),
					'left' 			=> $this->input->post('left'),
					'limpas' 		=> $this->input->post('limpas'),
					);

				$insertResult = $this->water->updateWater($dataInsert);

				if ($insertResult) {
					// redirect user 
					redirect('water');
				} else {
					redirect('login');
				}
		     	//Go to private area
				
			}
		}

		public function editWater($waterID = 0)
		{
			$this->load->library('irigasi/region');
			$this->load->library('irigasi/water');

			$condition 				= array('water.id' => $waterID);
			$data['regions'] 		= $this->region->getAllRegion();
			$data['water'] 			= $this->water->getSpecificWater($condition);
			
			$template['content'] 	= $this->load->view('integrated/pages/admin/water/update', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function editWaterAction()
		{
			$this->load->library('irigasi/water');
			$this->load->library('irigasi/region');

			$this->form_validation->set_rules('region-id', 'Region', 'trim|required|xss_clean');
			$this->form_validation->set_rules('date', 'Tanggal', 'trim|required|xss_clean');
			$this->form_validation->set_rules('right', 'Debit kanan', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_rules('left', 'Debit kiri', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_rules('limpas', 'Debit limpas', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if($this->form_validation->run() == FALSE)
			{
			    //Field validation failed.  User redirected to create page
				$this->session->set_flashdata('error', validation_errors());
				$condition 				= array('water.id' => $this->input->post('id'));
				$data['water'] 			= $this->water->getSpecificWater($condition);
				$data['regions'] 		= $this->region->getAllRegion();
				
				$template['content'] 	= $this->load->view('integrated/pages/admin/water/update', $data, true); 
				$this->load->view('integrated/master', $template);
			}
			else
			{
				$password = $this->input->post('password');
				// avoid change password if password is empty

				$dataInsert = array(
						'id'			=> $this->input->post('id'),
						'region_id' 	=> $this->input->post('region-id'),
						'date' 			=> $this->input->post('date'),
						'right' 		=> $this->input->post('right'),
						'left' 			=> $this->input->post('left'),
						'limpas' 		=> $this->input->post('limpas'),
					);

				$insertResult = $this->water->updateWater($dataInsert);

				if ($insertResult) {
					// redirect Region 
					redirect('water');
				} else {
					redirect('login');
				}
		     	//Go to private area
				
			}
		}

		public function deleteWater($waterID = 0)
		{
			$this->load->library('irigasi/water');

			$result = $this->water->deleteWater($waterID);

	 		redirect('water');
		}
	// END : water section =====================================================================================

	// juru get ajax data
		public function getAjaxWaterData()
		{
			$this->load->library('irigasi/water');

			$year 		= $this->input->get('year') ? : Date('Y');
			$month 		= $this->input->get('month') ? : Date('m');
			$regionID 	= $this->input->get('region-id');


			if ( ! $regionID) {
				$this->load->library('irigasi/region');
				$regionID 		= $this->region->getAllRegion()[0];
			} 

			$condition 		= array('region_id' => $regionID);
			$conditionLike  = array('date' => $year . '-' . $month);

			echo json_encode($this->water->getAllWater($condition, $conditionLike));			
		}

		public function getAjaxYearsData()
		{
			$this->load->library('irigasi/water');

			$regionID = $this->input->get('region-id');
			$condition = array('region_id' => $regionID);
			echo json_encode($this->water->getAllYear($condition));
		}

		public function addAjaxWaterData()
		{
			$this->load->library('irigasi/region');
			$this->load->library('irigasi/water');

			$this->form_validation->set_rules('region-id', 'Region', 'trim|required|xss_clean');
			$this->form_validation->set_rules('date', 'Tanggal', 'trim|required|xss_clean');
			$this->form_validation->set_rules('right', 'Debit kanan', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_rules('left', 'Debit kiri', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_rules('limpas', 'Debit limpas', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_error_delimiters('', '');

			if($this->form_validation->run() == FALSE)
			{
			    //Field validation failed.  User redirected to create page
				$result = array(
					'status' 	=> false,
					'error' 	=> array(
						'region-id' 	=> form_error('region-id'),
						'date' 			=> form_error('date'),
						'right' 		=> form_error('right'),
						'left'			=> form_error('left'),
						'limpas' 		=> form_error('limpas'), 
						)
					);
				
				$this->output->set_status_header('400');

			}
			else
			{
				$dataInsert = array(
					'region_id' 	=> $this->input->post('region-id'),
					'date' 			=> $this->input->post('date'),
					'right' 		=> $this->input->post('right'),
					'left' 			=> $this->input->post('left'),
					'limpas' 		=> $this->input->post('limpas'),
					);

				$insertResult = $this->water->updateWater($dataInsert);

				if ($insertResult) {
					// redirect user 
					$result = array(
						'status' 	=> true,
						'data' 		=> $insertResult,
						);

				} else {
					$result = array(
						'status' 	=> false,
						'data' 		=> 'Terdapat error saat memasukan data',
						);

					$this->output->set_status_header('400');

				}
		     	//Go to private area
				
			}

			echo json_encode($result);
		}

		public function getAjaxRegionData()
		{
			$this->load->library('irigasi/region');

			echo json_encode($this->region->getAllRegion());
		}
	// END : juru ajax data
}