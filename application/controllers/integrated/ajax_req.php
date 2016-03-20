<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_req extends CI_Controller {

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

			$regionID = $this->input->get_post('region-id');
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

			echo json_encode($this->region->getJuruRegion());
		}

		public function ajaxGetWide()
		{
			$this->load->library('irigasi/region');

			if($_POST) {
				$regionID = $this->input->post('region-id');
			} else {
				$data = json_decode(file_get_contents('php://input'));
				$regionID = $data->{'region-id'};
			}

			$data = $this->region->getRegionWide($regionID);
			
			echo json_encode($data);
		}
	// END : juru ajax data
	
	// water api
		public function apiWater($id='')
		{
			$method = $_SERVER['REQUEST_METHOD'];
			
			switch ($method) {
				case 'GET':
					if ($id) {
						$this->getWaterApi($id);
					} else {
						$this->getWaterByConditionApi();
					};
					break;
				case 'POST':
					if ($id) {
						$this->editWaterApi();
					} else {
						$this->addWaterApi();
					};
					break;
				case 'PUT':
					if ($id) {
						$this->editWaterApi();
					} else {
						$this->addWaterApi();
					};
					break;
				case 'DELETE':
					$this->deleteWaterApi($id);
					break;
				default:
					# code...
					break;
			}
		}

		private function getWaterApi($waterID)
		{
			$this->load->library('irigasi/water');

			$condition 		= array('water.id' => $waterID);
			
			echo json_encode($this->water->getAllWater($condition));
		}

		private function getWaterByConditionApi()
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

		private function addWaterApi()
		{
			$this->load->library('irigasi/region');
			$this->load->library('irigasi/water');

			$_POST = json_decode(file_get_contents("php://input"), true);

			$this->form_validation->set_rules('region_id', 'Region', 'trim|required|xss_clean');
			$this->form_validation->set_rules('date', 'Tanggal', 'trim|required|xss_clean');
			$this->form_validation->set_rules('right', 'Debit kanan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('left', 'Debit kiri', 'trim|required|xss_clean');
			$this->form_validation->set_rules('limpas', 'Debit limpas', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('', '');

			if($this->form_validation->run() == FALSE)
			{
			    //Field validation failed.  User redirected to create page
				$result = array(
					'status' 	=> false,
					'error' 	=> array(
						'region-id' 	=> form_error('region_id'),
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
					'region_id' 	=> $this->input->post('region_id'),
					'date' 			=> $this->input->post('date'),
					'right' 		=> floatval($this->input->post('right')),
					'left' 			=> floatval($this->input->post('left')),
					'limpas' 		=> floatval($this->input->post('limpas')),
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

		private function editWaterApi()
		{
			$this->load->library('irigasi/water');
			$this->load->library('irigasi/region');

			$_POST = json_decode(file_get_contents("php://input"), true);
			
			$this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');
			$this->form_validation->set_rules('region_id', 'Region', 'trim|required|xss_clean');
			$this->form_validation->set_rules('date', 'Tanggal', 'trim|required|xss_clean');
			$this->form_validation->set_rules('right', 'Debit kanan', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_rules('left', 'Debit kiri', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_rules('limpas', 'Debit limpas', 'trim|decimal|required|xss_clean');
			$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

			if($this->form_validation->run() == FALSE)
			{
			    //Field validation failed.  User redirected to create page
				
				$this->output->set_status_header('400');

				echo json_encode(array('msg', validation_errors()));

			}
			else
			{
				$password = $this->input->post('password');
				// avoid change password if password is empty

				$dataInsert = array(
						'id'			=> $this->input->post('id'),
						'region_id' 	=> $this->input->post('region_id'),
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
						'data' 		=> 'Terdapat error saat update data',
						);

					$this->output->set_status_header('400');

				}
		     	//Go to private area
				echo json_encode($result);
			}
		}

		private function deleteWaterApi($waterID)
		{
			$this->load->library('irigasi/water');

			$deleteResult = $this->water->deleteWater($waterID);

			if ($deleteResult) {
				// redirect user 
				$result = array(
					'status' 	=> true,
					'data' 		=> $deleteResult,
					);

			} else {
				$result = array(
					'status' 	=> false,
					'data' 		=> 'Terdapat error saat memasukan data',
					);

				$this->output->set_status_header('400');

			}

			echo json_encode($result);
		}
	// END : water api

	// allocation 
		public function ajaxAddAllocation()
		{
			$this->load->library('irigasi/water');
			$data = json_decode(file_get_contents('php://input'));
			$debitNext 		= $this->water->allocation(
				$data->region_id, 
				$data->growth, 
				$data->mature, 
				$data->harvest, 
				$data->palawija, 
				$data->sugar, 
				$data->bero);

			if($debitNext) {
				$this->water->saveAllocationData($data);
				echo json_encode(array(
							'status' => true,
							'data' 	=> $debitNext,
							));
			} else {
				echo json_encode(array(
							'status' => false,
							'data' 	=> $debitNext,
							));
			}
		}

		public function ajaxRegionAllocation($regionID=1)
		{
			$this->load->model('allocation_model');
			$data = $this->allocation_model->find(array('region_id' => $regionID))->result();

			echo json_encode($data);
		}

		public function ajaxAllocationCalc($id=0)
		{
			$this->load->library('irigasi/water');
			$this->load->model('allocation_model');
			$data = $this->allocation_model->find(array('id' => $id))->row();

			$debitNext 		= $this->water->allocation(
				$data->region_id, 
				$data->rice_growth_fase, 
				$data->rice_mature_fase, 
				$data->rice_harvest_face, 
				$data->palawija, 
				$data->sugar, 
				$data->bero);

			if($debitNext) {
				echo json_encode(array(
							'status' => true,
							'data' 	=> $debitNext,
							'periode' => $data->periode,
							));
			} else {
				echo json_encode(array(
							'status' => false,
							'data' 	=> $debitNext,
							));
			}
		}
	// END OF ALLOCATION 
}