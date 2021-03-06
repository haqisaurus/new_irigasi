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
			

		// if ($this->agent->is_mobile()) {
		// 	$this->load->view('mobile/mobile-view', '');
		// } else {
		// 	$template['content'] 	= $this->load->view('integrated/pages/admin/dashboard', '', true); 
		// 	$this->load->view('integrated/master', $template);
		// }
		$this->load->view('mobile/mobile-view', '');

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
			$this->load->library('irigasi/region');
			$data['regions'] 		= $this->region->getAllRegion();

			$data['table'] 	= array();
			$regionID 		= $regionID ? : $data['regions'][0]->id;
			$condition 		= array('region_id' => $regionID);
			
			$data['years'] 	= $this->water->getAllYear($condition);

			if ($_POST) {
				
				$conditionLike  = array('date' => $year . '-' . sprintf("%02d", $month));
				$data['table'] 	= $this->water->getAllWaterASC($condition, $conditionLike);
			}
			
			$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
			$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
			$template['content'] = $this->load->view('frontend/pages/pimpinan/debit-list', $data, true);
			$this->load->view('frontend/master', $template);
		}

		public function createWater()
		{
			$this->load->library('irigasi/region');
			$data['regions'] 		= $this->region->getAllRegion();

			$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
			$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
			$template['content'] = $this->load->view('frontend/pages/pimpinan/debit-add', $data, true);
			$this->load->view('frontend/master', $template);
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
					redirect('pimpinan-debit-view');
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
			$data['update'] 			= $this->water->getSpecificWater($condition);
			
			$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
			$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
			$template['content'] = $this->load->view('frontend/pages/pimpinan/debit-edit', $data, true);
			$this->load->view('frontend/master', $template);

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
				$data['update'] 			= $this->water->getSpecificWater($condition);
				$data['regions'] 		= $this->region->getAllRegion();
				
				$template['menuTop'] = $this->load->view('frontend/part/nav-top', 0, true);
				$template['sideBar'] = $this->load->view('frontend/part/nav-right', '', true);
				$template['content'] = $this->load->view('frontend/pages/pimpinan/debit-edit', $data, true);
				$this->load->view('frontend/master', $template);
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
					redirect('pimpinan-debit-edit/' . $this->input->post('id'));
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

	 		$previousPage = $_SERVER["HTTP_REFERER"];
			header('Location: '.$previousPage);

		}
	// END : water section =====================================================================================

	
}