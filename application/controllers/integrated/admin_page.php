<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_page extends CI_Controller {

	var $template = array();
	var $limit = 20;

	public function index()
	{
		$template['content'] 	= $this->load->view('integrated/pages/admin/dashboard', '', true); 
		$this->load->view('integrated/master', $template);
	}

	// user section =====================================================================================
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
				$condition 				= array('user.id' => $this->input->post('id'));
				$data['user'] 			= $this->user->getSpecificUser($condition);
				$template['content'] 	= $this->load->view('integrated/pages/admin/user/update', $data, true); 
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
	// END : user section =====================================================================================

	// role section =====================================================================================
		public function viewRole($value='')
		{
			$this->load->library('irigasi/role');
			$data['table'] = $this->role->getAllRole();

			$template['content'] 	= $this->load->view('integrated/pages/admin/role/view', $data, true); 
			$this->load->view('integrated/master', $template);
		}
	// END : role section =====================================================================================

	// juru access section =====================================================================================
		public function viewJuru()
		{
			$this->load->library('irigasi/user');
			$condition = array('role_id' => 2);
			$data['table'] = $this->user->getAllUser($condition);

			$template['content'] 	= $this->load->view('integrated/pages/admin/juru-access/view', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function editJuru($juruID = 0)
		{
			$this->load->library('irigasi/user');
			$this->load->library('irigasi/region');
			$condition 				= array('user.id' => $juruID);
			$data['user'] 			= $this->user->getSpecificUser($condition);
			$data['regions'] 		= $this->region->getAllRegion();
			
			$template['content'] 	= $this->load->view('integrated/pages/admin/juru-access/update', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function editJuruAction()
		{
			
		}
	// END : juru access section =====================================================================================

	// region section =====================================================================================
		public function viewRegion()
		{
			$this->load->library('irigasi/region');
			$data['table'] = $this->region->getAllRegion();

			$template['content'] 	= $this->load->view('integrated/pages/admin/region/view', $data, true); 
			$template['popup'] 	= $this->load->view('integrated/pages/admin/region/popup', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function createRegion()
		{
			$template['content'] 	= $this->load->view('integrated/pages/admin/region/create', '', true); 
			$this->load->view('integrated/master', $template);
		}

		public function createRegionAction()
		{
			$this->load->library('irigasi/region');

			$this->form_validation->set_rules('region-name', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if($this->form_validation->run() == FALSE)
			{
			    //Field validation failed.  User redirected to create page
				$this->session->set_flashdata('error', validation_errors());
				$template['content'] 	= $this->load->view('integrated/pages/admin/region/create', '', true); 
				$this->load->view('integrated/master', $template);
			}
			else
			{
				$dataInsert = array(
					'region_name' 		=> $this->input->post('region-name'),
					);

				$insertResult = $this->region->updateRegion($dataInsert);

				if ($insertResult) {
					// redirect user 
					redirect('region');
				} else {
					redirect('login');
				}
		     	//Go to private area
				
			}
		}

		public function editRegion($regionID = 0)
		{
			$this->load->library('irigasi/region');
			$condition 				= array('region.id' => $regionID);
			$data['region'] 			= $this->region->getSpecificRegion($condition);
			
			$template['content'] 	= $this->load->view('integrated/pages/admin/region/update', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function editRegionAction()
		{
			$this->load->library('irigasi/region');

			$this->form_validation->set_rules('region-name', 'Nama Daerah', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if($this->form_validation->run() == FALSE)
			{
			    //Field validation failed.  User redirected to create page
				$this->session->set_flashdata('error', validation_errors());
				$condition 				= array('region.id' => $this->input->post('id'));
				$data['region'] 			= $this->region->getSpecificRegion($condition);
				$template['content'] 	= $this->load->view('integrated/pages/admin/region/update', $data, true); 
				$this->load->view('integrated/master', $template);
			}
			else
			{
				$password = $this->input->post('password');
				// avoid change password if password is empty

				$dataInsert = array(
						'id'			=> $this->input->post('id'),
						'region_name' 	=> $this->input->post('region_name'),
					);

				$insertResult = $this->region->updateRegion($dataInsert);

				if ($insertResult) {
					// redirect Region 
					redirect('region');
				} else {
					redirect('login');
				}
		     	//Go to private area
				
			}

		}

		public function deleteRegion($regionID = 0)
		{
			$this->load->library('irigasi/region');

			$result = $this->region->deleteRegion($regionID);

	 		redirect('region');
		}
	// END : region section =====================================================================================

	// wide section =====================================================================================
		public function viewWide()
		{
			$this->load->library('irigasi/wide');
			$data['table'] = $this->wide->getAllWide();

			$template['content'] 	= $this->load->view('integrated/pages/admin/wide/view', $data, true); 
			$template['popup'] 	= $this->load->view('integrated/pages/admin/wide/popup', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function createWide()
		{
			$this->load->library('irigasi/region');
			$data['regions'] 		= $this->region->getAllRegion();

			$template['content'] 	= $this->load->view('integrated/pages/admin/wide/create', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function createWideAction()
		{
			$this->load->library('irigasi/region');
			$this->load->library('irigasi/wide');

			$this->form_validation->set_rules('region-id', 'Region', 'trim|required|xss_clean');
			$this->form_validation->set_rules('area-name', 'Nama Area', 'trim|required|xss_clean');
			$this->form_validation->set_rules('wide', 'Luas', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if($this->form_validation->run() == FALSE)
			{
			    //Field validation failed.  User redirected to create page
				$this->session->set_flashdata('error', validation_errors());
				$data['regions'] 		= $this->region->getAllRegion();
				$template['content'] 	= $this->load->view('integrated/pages/admin/wide/create', $data, true); 
				$this->load->view('integrated/master', $template);
			}
			else
			{
				$dataInsert = array(
					'area_name' 		=> $this->input->post('area-name'),
					'region_id' 		=> $this->input->post('region-id'),
					'wide' 				=> $this->input->post('wide'),
					);

				$insertResult = $this->wide->updateWide($dataInsert);

				if ($insertResult) {
					// redirect user 
					redirect('wide');
				} else {
					redirect('login');
				}
		     	//Go to private area
				
			}
		}

		public function editWide($wideID = 0)
		{
			$this->load->library('irigasi/region');
			$this->load->library('irigasi/wide');

			$condition 				= array('wide.id' => $wideID);
			$data['regions'] 		= $this->region->getAllRegion();
			$data['wide'] 			= $this->wide->getSpecificWide($condition);
			
			$template['content'] 	= $this->load->view('integrated/pages/admin/wide/update', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function editWideAction()
		{
			$this->load->library('irigasi/wide');
			$this->load->library('irigasi/region');

			$this->form_validation->set_rules('region-id', 'Region', 'trim|required|xss_clean');
			$this->form_validation->set_rules('area-name', 'Nama Area', 'trim|required|xss_clean');
			$this->form_validation->set_rules('wide', 'Luas', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if($this->form_validation->run() == FALSE)
			{
			    //Field validation failed.  User redirected to create page
				$this->session->set_flashdata('error', validation_errors());
				$condition 				= array('region.id' => $this->input->post('id'));
				$data['wide'] 			= $this->wide->getSpecificWide($condition);
				$data['regions'] 		= $this->region->getAllRegion();
				
				$template['content'] 	= $this->load->view('integrated/pages/admin/wide/update', $data, true); 
				$this->load->view('integrated/master', $template);
			}
			else
			{
				$password = $this->input->post('password');
				// avoid change password if password is empty

				$dataInsert = array(
						'id'			=> $this->input->post('id'),
						'area_name' 		=> $this->input->post('area-name'),
						'region_id' 		=> $this->input->post('region-id'),
						'wide' 				=> $this->input->post('wide'),
					);

				$insertResult = $this->wide->updateWide($dataInsert);

				if ($insertResult) {
					// redirect Region 
					redirect('wide');
				} else {
					redirect('login');
				}
		     	//Go to private area
				
			}
		}

		public function deleteWide($wideID = 0)
		{
			$this->load->library('irigasi/wide');

			$result = $this->wide->deleteWide($wideID);

	 		redirect('wide');
		}
	// END : wide section =====================================================================================

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

	// debit andalan section =====================================================================================
		public function getDebitAndalan()
		{
			$this->load->library('irigasi/water');
			$this->load->library('irigasi/region');

			$regionID 		= $this->input->post('region-id') ? : null;
			$dataAndalan 	= $this->water->getDataAndalan($regionID);
			$resultAndalan 	= array();
			$year 			= date('Y');
			
			foreach ($dataAndalan as $key => $value) {
				
				$month = $key + 1;
				array_push($resultAndalan, array(
						'month' => $year . '-' . $month,
						'debit' => $value
					));
			}

			$data['regions'] 		= $this->region->getAllRegion();
			$data['current_reg']	= $regionID ? $this->region->getSpecificRegion(array('id' => $regionID))->region_name : $data['regions'][0]->region_name;
			$data['andalan'] 		= $resultAndalan;
			$template['content'] 	= $this->load->view('integrated/pages/admin/debit-andalan/view-andalan', $data, true); 
			$this->load->view('integrated/master', $template);
		}
	// END : debit andalan section =====================================================================================

	// data water demand ==========================================================================================
		public function getWaterDemand()
		{
			$this->load->library('irigasi/water');
			$waterDemand = $this->water->getDataWaterDemand();
			$dataAndalan = $this->water->getDataAndalan(null, 11);
			$year = date('Y');
			$resultAndalan = array();
			
			foreach ($dataAndalan as $key => $value) {
				
				$neraca = $value - $waterDemand[$key]['irigasi'];
				array_push($resultAndalan, array(
						'month' => $year . '-' . $key,
						'debit' => $value,
						'demand' => $waterDemand[$key]['irigasi'],
						'neraca' => $neraca,
					));
			}
			
			$data['current_reg']	= '';
			$data['andalan'] 		= $resultAndalan;
			
			$template['content'] 	= $this->load->view('integrated/pages/admin/plant-plan/view-plant', $data, true); 
			$this->load->view('integrated/master', $template);
		}
	// END : data water demand ==========================================================================================

	// masa tanam ==================================================================================================
		public function plan()
		{
			$this->load->library('irigasi/region');
			$data['regions'] 		= $this->region->getAllRegion();

			$template['content'] 	= $this->load->view('integrated/pages/admin/plant-plan/form-plan', $data, true); 
			$this->load->view('integrated/master', $template);
		}

		public function planDataCalc()
		{
			$this->load->library('irigasi/region');
			$this->load->library('irigasi/water');
			// =================== data water demand =============

			$regionID 	= $this->input->post('region-id');
			$year 		= $this->input->post('year');
			$startMonth = $this->input->post('month');
			$range 		= explode(',', $this->input->post('range'));
			$rice 		= $this->input->post('rice');
			$palawija 	= $this->input->post('palawija');
			$sugar 		= $this->input->post('sugar');
			$bero 		= $this->input->post('bero');

			
			$waterDemand = $this->water->planData($regionID, $year, $startMonth, $range, $rice, $palawija, $sugar, $bero);

			// =================== data andalan =============
			$dataAndalan = $this->water->getDataAndalan($regionID, $startMonth);
			$year = date('Y');
			$resultAndalan = array();
			
			foreach ($dataAndalan as $key => $value) {
				
				$neraca = $value - $waterDemand[$key]['data']['water-irigasi'];
				array_push($resultAndalan, array(
						'month' => $year . '-' . $key,
						'month_string' =>  $waterDemand[$key]['month'],
						'debit' => $value,
						'demand' => $waterDemand[$key]['data']['water-irigasi'],
						'neraca' => $neraca,
					));
			}
			
			$data['current_reg']	= $this->region->getSpecificRegion(array('id' => $regionID))->region_name;
			$data['andalan'] 		= $resultAndalan;

			$template['content'] 	= $this->load->view('integrated/pages/admin/plant-plan/view-plant', $data, true); 
			$this->load->view('integrated/master', $template);

		}
	// END : masa tanam ==================================================================================================
}