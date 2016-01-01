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

			$regionID = $this->input->post('region-id');

			$data = $this->region->getRegionWide($regionID);
			
			echo json_encode($data);
		}
	// END : juru ajax data
	
}